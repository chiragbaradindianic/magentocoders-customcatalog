<?php
namespace MagentoCoders\CustomCatalog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use MagentoCoders\CustomCatalog\Api\Data\ProductInterface;

/**
 * Interface ProductRepositoryInterface
 * @package MagentoCoders\CustomCatalog\Api
 */
interface ProductRepositoryInterface
{
    /**
     * Save product.
     *
     * @param ProductInterface $product
     * @return ProductInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(ProductInterface $product);


    /**
     * Retrieve product.
     *
     * @param string $productId
     * @return ProductInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($productId);

    /**
     * Retrieve product by vpn.
     *
     * @param string $vpn
     * @param SearchCriteriaInterface $searchCriteria
     * @return MagentoCoders\CustomCatalog\Api\Data\ProductSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     **/
    public function getByVPN($vpn, SearchCriteriaInterface $searchCriteria);

    /**
     * product Update
     * @param string $productId
     * @return ProductInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     **/
    public function getProductUpdate($productId);

}
