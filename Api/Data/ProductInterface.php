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
