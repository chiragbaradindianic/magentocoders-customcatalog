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
    /**
     * Initialize model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\MagentoCoders\CustomCatalog\Model\ResourceModel\Relation::class);
    }

    /**
     * Retrieve Product Id
     *
     * @return int
     */
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * Retrieve Store Id
     *
     * @return int
     */
    public function getStoreId()
    {
        return $this->getData(self::STORE_ID);
    }

    /**
     * Retrieve Copywrite info Id
     *
     * @return string
     */
    public function getCopyWriteInfo()
    {
        return $this->getData(self::COPY_WRITE_INFO);
    }
    /**
     * Set ProductID
     *
     * @param int $productId
     * @return RelationInterface
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * Set StoreID
     *
     * @param int $storeId
     * @return RelationInterface
     */
    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * Set CopyWriteInfo
     *
     * @param string $copyWriteInfo
     * @return RelationInterface
     */
    public function setCopyWriteInfo($copyWriteInfo)
    {
        return $this->setData(self::COPY_WRITE_INFO, $copyWriteInfo);
    }
}
