<?php
namespace MagentoCoders\CustomCatalog\Block\Adminhtml\Product\Edit\Button;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class Delete
 * @package MagentoCoders\CustomCatalog\Block\Adminhtml\Product\Edit\Button
 */
class Delete extends Generic implements ButtonProviderInterface
{
    /**
     * @var Context
     */
    protected $context;
    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }
    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        $blog_id = $this->context->getRequest()->getParam('product_id');
        if ($blog_id) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }
    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        $productId = $this->context->getRequest()->getParam('product_id');
        return $this->getUrl('*/*/delete', ['product_id' => $productId]);
    }
}
