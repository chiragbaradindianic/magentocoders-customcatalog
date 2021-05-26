<?php
namespace MagentoCoders\CustomCatalog\Model\ResourceModel\Relation;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use MagentoCoders\CustomCatalog\Model\ResourceModel\Relation;

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
        $this->_init(\MagentoCoders\CustomCatalog\Model\Relation::class, Relation::class);
    }
}
