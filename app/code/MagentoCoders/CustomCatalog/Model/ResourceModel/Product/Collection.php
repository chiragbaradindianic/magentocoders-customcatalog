<?php


namespace MagentoCoders\CustomCatalog\Model\ResourceModel\Product;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package MagentoCoders\CustomCatalog\Model\ResourceModel\Product
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'product_id';

    /**
     * Define model & resource model
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\MagentoCoders\CustomCatalog\Model\Product::class, \MagentoCoders\CustomCatalog\Model\ResourceModel\Product::class);
    }
}
