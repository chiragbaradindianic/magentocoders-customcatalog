<?php
namespace MagentoCoders\CustomCatalog\Controller\Adminhtml\Product;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\Session;
use MagentoCoders\CustomCatalog\Model\Product;
use MagentoCoders\CustomCatalog\Model\ResourceModel\Product\CollectionFactory;
use MagentoCoders\CustomCatalog\Model\ProductFactory;
use MagentoCoders\CustomCatalog\Model\ProductRepository;
use MagentoCoders\CustomCatalog\Model\RelationRepository;
use MagentoCoders\CustomCatalog\Model\RelationFactory;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\DataObject\IdentityGeneratorInterface;
use Magento\AsynchronousOperations\Api\Data\OperationInterfaceFactory;
use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\AsynchronousOperations\Api\Data\OperationInterface;

/**
 * Class Save
 * @package MagentoCoders\CustomCatalog\Controller\Adminhtml\Product
 */
class Save extends \Magento\Backend\App\Action
{
    /**
     * @var Product
     */
    private $productModel;
    /**
     * @var Session
     */
    private $adminsession;
       /**
     * @var ProductFactory
     */
    private $productFactory;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var RelationFactory
     */
    private $relationFactory;
    /**
     * @var RelationRepository
     */
    private $relationRepository;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var PublisherInterface
     */
    private $publisher;
    /**
     * @var OperationInterfaceFactory
     */
    private $operationFactory;
    /**
     * @var IdentityGeneratorInterface
     */
    private $identityService;
    /**
     * @var Json
     */
    private $serializer;

    /**
     * Save constructor.
     * @param Context $context
     * @param Product $productModel
     * @param RelationFactory $relationFactory
     * @param RelationRepository $relationRepository
     * @param ProductFactory $productFactory
     * @param ProductRepository $productRepository
     * @param CollectionFactory $collectionFactory
     * @param PublisherInterface $publisher
     * @param OperationInterfaceFactory $operationFactory
     * @param IdentityGeneratorInterface $identityService
     * @param Json $serializer
     * @param Session $adminsession
     */
    public function __construct
    (
        Context $context,
        Product $productModel,
        RelationFactory $relationFactory,
        RelationRepository $relationRepository,
        ProductFactory $productFactory,
        ProductRepository $productRepository,
        CollectionFactory $collectionFactory,
        PublisherInterface $publisher,
        OperationInterfaceFactory $operationFactory,
        IdentityGeneratorInterface $identityService,
        Json $serializer,
        Session $adminsession
    ) {
        parent::__construct($context);
        $this->productModel = $productModel;
        $this->adminsession = $adminsession;
        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;
        $this->relationFactory = $relationFactory;
        $this->relationRepository = $relationRepository;
        $this->collectionFactory = $collectionFactory;
        $this->publisher = $publisher;
        $this->operationFactory = $operationFactory;
        $this->identityService = $identityService;
        $this->serializer = $serializer;
    }

    /**
     * Save Product action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $storeId = $this->getRequest()->getParam('store_id');
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        $model = $this->productFactory->create();
        if ($data) {
            $productId = $this->getRequest()->getParam('product_id');
            if ($productId) {
                $model =  $this->productRepository->getById($productId);
                if($model->getSku() != $data['sku']) {
                    $productCollection = $this->collectionFactory->create();
                    $productCollection->addFieldToFilter('sku', ['eq' => $data['sku']]);
                    if(count($productCollection) > 0)
                    {
                        $this->messageManager->addErrorMessage(__('SKU already exists.'));
                        return $resultRedirect->setPath('*/*/edit', ['product_id' => $this->getRequest()->getParam('product_id')]);
                    }
                }
            }  else {
                $productCollection = $this->collectionFactory->create();
                $productCollection->addFieldToFilter('sku',['eq' => $data['sku']]);
                if(count($productCollection) > 0)
                {
                    $this->messageManager->addErrorMessage(__('SKU already exists.'));
                    return $resultRedirect->setPath('*/*/edit', ['product_id' => $this->getRequest()->getParam('product_id')]);
                }
            }
            $model->setData($data);
            try {
                $this->productRepository->save($model);

                $serializedData= $this->serializer->serialize($data);
                $bulkUuid = $this->identityService->generateId();
                $data = [
                    'data' => [
                        'bulk_uuid' => $bulkUuid,
                        'topic_name' => 'customcatalog.product',
                        'serialized_data' => $serializedData,
                        'status' => OperationInterface::STATUS_TYPE_OPEN,
                    ]
                ];
                $operation = $this->operationFactory->create($data);
                $this->publisher->publish('customcatalog.product', $operation);


                $this->messageManager->addSuccessMessage(__('The product has been saved.'));
                $this->adminsession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return $resultRedirect->setPath('*/*/add');
                    } else {
                        return $resultRedirect->setPath('*/*/edit', ['product_id' => $this->productModel->getProductId(), '_current' => true]);
                    }
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the product.'));
            }
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['product_id' => $this->getRequest()->getParam('product_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
