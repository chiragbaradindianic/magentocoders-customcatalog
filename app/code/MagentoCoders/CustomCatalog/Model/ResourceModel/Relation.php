<?php


namespace MagentoCoders\CustomCatalog\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Relation extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('customcatalog_store', 'product_id');
    }
}
