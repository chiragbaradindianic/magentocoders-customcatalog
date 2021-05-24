<?php


namespace MagentoCoders\CustomCatalog\Controller\Adminhtml\Product;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Delete extends Action
{
    /**
     * @var \MagentoCoders\CustomCatalog\Model\Product
     */
    private $ProductModel;

    /**
     * Delete constructor.
     * @param Context $context
     * @param \MagentoCoders\CustomCatalog\Model\Product $ProductModel
     */
    public function __construct(
        Context $context,
        \MagentoCoders\CustomCatalog\Model\ProductFactory $ProductModel
    ) {
        parent::__construct($context);
        $this->ProductModel = $ProductModel;
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
                $model = $this->ProductModel->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Product deleted successfully.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['product_id' => $id]);
            }
        }
        $this->messageManager->addError(__('Product does not exist.'));
        return $resultRedirect->setPath('*/*/');
    }
}
