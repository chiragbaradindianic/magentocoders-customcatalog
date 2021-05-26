<?php
namespace MagentoCoders\CustomCatalog\Api;

/**
 * Interface RelationRepositoryInterface
 * @package MagentoCoders\CustomCatalog\Api
 */
interface RelationRepositoryInterface
{
    /**
     * Save product.
     *
     * @param MagentoCoders\CustomCatalog\Api\Data\RelationInterface $product
     * @return MagentoCoders\CustomCatalog\Api\Data\RelationInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\MagentoCoders\CustomCatalog\Api\Data\RelationInterface $product);


    /**
     * Retrieve product.
     *
     * @param string $productId
     * @return MagentoCoders\CustomCatalog\Api\Data\RelationInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($productId);
}
