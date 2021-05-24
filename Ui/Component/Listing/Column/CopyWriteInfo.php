<?php

namespace MagentoCoders\CustomCatalog\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use MagentoCoders\CustomCatalog\Model\ResourceModel\Relation\CollectionFactory;

/**
 * Class CopyWriteInfo
 * @package MagentoCoders\CustomCatalog\Ui\Component\Listing\Column
 */
class CopyWriteInfo extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var Relation
     */
    private $relation;

    /**
     * CopyWriteInfo constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param CollectionFactory $relation
     * @param array $components
     * @param array $data
     */
    public function __construct
    (
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        CollectionFactory $relation,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->relation = $relation;
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                //print_r($item);
                $item['copy_write_info'] = $this->getCopyWriteInfo($item['product_id']);
            }
        }

        return $dataSource;
    }

    /**
     * @param $productId
     * @return array
     */
    public function getCopyWriteInfo($productId)
    {
        $collection = $this->relation->create();
        $collection->addFieldToFilter('product_id',['eq' => $productId])
            ->addFieldToFilter('store_id',['eq' => '0']);
        return $collection->getColumnValues('copy_write_info');
    }
}
