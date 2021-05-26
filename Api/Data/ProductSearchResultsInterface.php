<?php


namespace MagentoCoders\CustomCatalog\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface ProductSearchResultsInterface
 * @package MagentoCoders\CustomCatalog\Api\Data
 */
interface ProductSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get list.
     *
     * @return \MagentoCoders\CustomCatalog\Api\Data\ProductInterface[]
     */
    public function getItems();

    /**
     * Set list.
     *
     * @param \MagentoCoders\CustomCatalog\Api\Data\ProductInterface[] $items
     * @return $this
     */
    public function setItems(array $items);

}
