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
