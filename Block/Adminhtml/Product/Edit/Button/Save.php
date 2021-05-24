<?php


namespace MagentoCoders\CustomCatalog\Block\Adminhtml\Product\Edit\Button;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;
use Magento\Framework\App\RequestInterface;

/**
 * Class Save
 * @package MagentoCoders\CustomCatalog\Block\Adminhtml\Product\Edit\Button
 */
class Save extends Generic implements ButtonProviderInterface
{


    /**
     * @var RequestInterface
     */
    private $request;

    public function __construct
    (
        RequestInterface $request,
        Context $context
    ) {
        parent::__construct($context);
        $this->request = $request;
    }

    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        $storeId = $this->request->getParam('store');
        if($storeId == null)
        {
            $storeId = 0;
        }
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'customcatalog_form.customcatalog_form',
                                'actionName' => 'save',
                                'params' => [ true,['store_id' => $storeId]
                                    ],
                            ],
                        ],
                    ],
                ],
            ],
            'class_name' => Container::SPLIT_BUTTON,
            'options' => $this->getOptions(),
        ];
    }
    /**
     * Retrieve options
     *
     * @return array
     */
    protected function getOptions()
    {
        $options[] = [
            'id_hard' => 'save_and_new',
            'label' => __('Save & New'),
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'customcatalog_form.customcatalog_form',
                                'actionName' => 'save',
                                'params' => [
                                    true, [
                                        'back' => 'add',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $options[] = [
            'id_hard' => 'save_and_close',
            'label' => __('Save & Close'),
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'customcatalog_form.customcatalog_form',
                                'actionName' => 'save',
                                'params' => [true],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        return $options;
    }
}
