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
     * Save constructor.
     * @param Context $context
     * @param Product $productModel
     * @param RelationFactory $relationFactory
     * @param RelationRepository $relationRepository
     * @param ProductFactory $productFactory
     * @param ProductRepository $productRepository
     * @param CollectionFactory $collectionFactory
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
            $product_id = $this->getRequest()->getParam('product_id');
            if ($product_id) {
                $model =  $this->productRepository->getById($product_id);
                if($model->getSku() != $data['sku']) {
                    $productCollection = $this->collectionFactory->create();
                    $productCollection->addFieldToFilter('sku', ['eq' => $data['sku']]);
                    if(count($productCollection) > 0)
                    {
                        $this->messageManager->addErrorMessage(__('SKU already exists.'));
                        return $resultRedirect->setPath('*/*/edit', ['product_id' => $this->getRequest()->getParam('product_id')]);
                    }
                }
            }
            else {
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
                $this->messageManager->addSuccess(__('The product has been saved.'));
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
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the product.'));
            }
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['product_id' => $this->getRequest()->getParam('product_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
