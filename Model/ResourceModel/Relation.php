<?php
namespace MagentoCoders\CustomCatalog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Relation
 * @package MagentoCoders\CustomCatalog\Model\ResourceModel
 */
class Relation extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('customcatalog_store', 'product_id');
    }
}
