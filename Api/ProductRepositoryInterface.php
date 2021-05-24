<?php


namespace MagentoCoders\CustomCatalog\Api;

/**
 * Interface ProductRepositoryInterface
 * @package MagentoCoders\CustomCatalog\Api
 */
interface ProductRepositoryInterface
{
    /**
     * Save product.
     *
     * @param MagentoCoders\CustomCatalog\Api\Data\ProductInterface $product
     * @return MagentoCoders\CustomCatalog\Api\Data\ProductInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\MagentoCoders\CustomCatalog\Api\Data\ProductInterface $product);


    /**
     * Retrieve product.
     *
     * @param string $productId
     * @return MagentoCoders\CustomCatalog\Api\Data\ProductInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($productId);

    /**
     * Retrieve product by vpn.
     *
     * @param string $vpn
     * @return MagentoCoders\CustomCatalog\Api\Data\ProductInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     **/
    public function getByVPN($vpn);

    /**
     * product Update
     * @param string $productId
     * @return MagentoCoders\CustomCatalog\Api\Data\ProductInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     **/
    public function getProductUpdate($productId);

}
