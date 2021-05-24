<?php


namespace MagentoCoders\CustomCatalog\Model;


use Magento\Framework\Model\AbstractModel;
use Magento\Framework\App\ResourceConnection;
use MagentoCoders\CustomCatalog\Api\Data\RelationInterface;

/**
 * Class Relation
 * @package MagentoCoders\CustomCatalog\Model
 */
class Relation extends AbstractModel implements RelationInterface
{

    protected function _construct()
    {
        $this->_init(\MagentoCoders\CustomCatalog\Model\ResourceModel\Relation::class);
    }

    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    public function getStoreId()
    {
        return $this->getData(self::STORE_ID);
    }

    public function getCopyWriteInfo()
    {
        return $this->getData(self::COPY_WRITE_INFO);
    }

    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    public function setCopyWriteInfo($copyWriteInfo)
    {
        return $this->setData(self::COPY_WRITE_INFO, $copyWriteInfo);
    }


}
