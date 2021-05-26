<?php
namespace MagentoCoders\CustomCatalog\Controller\Adminhtml\Product;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Delete extends Action
{
    /**
     * @var \MagentoCoders\CustomCatalog\Model\ProductFactory
     */
    private $productModel;


    /**
     * Delete constructor.
     * @param Context $context
     * @param \MagentoCoders\CustomCatalog\Model\Product $ProductModel
     */
    public function __construct(
        Context $context,
        \MagentoCoders\CustomCatalog\Model\ProductFactory $productModel
    ) {
        parent::__construct($context);
        $this->productModel = $productModel;
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('product_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->productModel->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('Product deleted successfully.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['product_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('Product does not exist.'));
        return $resultRedirect->setPath('*/*/');
    }
}
