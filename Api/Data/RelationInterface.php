<?php
namespace MagentoCoders\CustomCatalog\Api\Data;

/**
 * Interface RelationInterface
 * @package MagentoCoders\CustomCatalog\Api\Data
 */
interface RelationInterface
{
    const PRODUCT_ID        = 'product_id';
    const COPY_WRITE_INFO   = 'copy_write_info';
    const STORE_ID          = 'store_id';


    /**
     * Get ProductId
     *
     * @return int|null
     */
    public function getProductId();

    /**
     * Get copy write info
     *
     * @return string
     */
    public function getCopyWriteInfo();

    /**
     * Get store id
     *
     * @return string
     */
    public function getStoreId();

    /**
     * Set PRODUCT ID
     *
     * @param int $productId
     * @return RelationInterface
     */
    public function setProductId($productId);

    /**
     * Set copy Write Info
     *
     * @param string $copyWriteInfo
     * @return RelationInterface
     */
    public function setCopyWriteInfo($copyWriteInfo);

    /**
     * Set store id
     *
     * @param string $storeId
     * @return RelationInterface
     */
    public function setStoreId($storeId);
}
