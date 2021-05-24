<?php

namespace MagentoCoders\CustomCatalog\Controller\Adminhtml\Product;

/**
 * Class Index
 * @package MagentoCoders\CustomCatalog\Controller\Adminhtml\Product
 */
class Index extends \Magento\Backend\App\Action
{
    /**
     * Index constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Product'));
        return $resultPage;
    }
}