<?php
/**
 * MagentoCoders
 * Copyright (C) 2021 MagentoCoders <info@magentocoders.com>
 *
 * NOTICE OF LICENSE
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://opensource.org/licenses/gpl-3.0.html.
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    MagentoCoders
 * @package     MagentoCoders_CustomCatalog
 * @copyright   Copyright (C) 2021 MagentoCoders (http://www.magentocoders.com/)
 * @license     http://www.magentocoders.com/license-agreement.html
 * @author      MagentoCoders <info@magentocoders.com>
 */

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
