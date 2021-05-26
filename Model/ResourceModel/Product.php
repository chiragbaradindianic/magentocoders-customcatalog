<?php
namespace MagentoCoders\CustomCatalog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;


/**
 * Class Product
 * @package MagentoCoders\CustomCatalog\Model\ResourceModel
 */
class Product extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('magentocoders_customcatalog', 'product_id');
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this|AbstractDb
     */
    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        parent::_afterSave($object);
        $table = $this->getTable('customcatalog_store');
        $data = ['product_id'=>$object['product_id'],'store_id'=>$object['store_id'],'copy_write_info'=>$object['copy_write_info']];
        $this->getConnection()->insertOnDuplicate($table,$data);
        return $this;
    }
}
