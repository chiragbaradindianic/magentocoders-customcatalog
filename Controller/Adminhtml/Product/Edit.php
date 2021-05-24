<?php


namespace MagentoCoders\CustomCatalog\Controller\Adminhtml\Product;

use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {

        //$this->getRequest()->setParams('store',$this->getRequest()->getParam('store'));
        $this->getRequest()->setPostValue('store',$this->getRequest()->getParam('store'));
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Product'));
        return $resultPage;
    }
}
