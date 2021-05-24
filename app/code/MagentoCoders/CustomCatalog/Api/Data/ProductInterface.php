<?php


namespace MagentoCoders\CustomCatalog\Api\Data;

/**
 * Interface ProductInterface
 * @package MagentoCoders\CustomCatalog\Api\Data
 */
interface ProductInterface
{
    const PRODUCT_ID    = 'product_id';
    const SKU           = 'sku';
    const VPN           = 'vpn';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME   = 'update_time';

    /**
     * Get ProductId
     *
     * @return int|null
     */
    public function getProductId();

    /**
     * Get sku
     *
     * @return string
     */
    public function getSku();

    /**
     * Get vpn
     *
     * @return string
     */
    public function getVpn();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Set PRODUCT ID
     *
     * @param int $productId
     * @return ProductInterface
     */
    public function setProductId($productId);

    /**
     * Set SKU
     *
     * @param string $sku
     * @return ProductInterface
     */
    public function setSku($sku);

    /**
     * Set VPN
     *
     * @param string $vpn
     * @return ProductInterface
     */
    public function setVpn($vpn);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return ProductInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return ProductInterface
     */
    public function setUpdateTime($updateTime);
}
