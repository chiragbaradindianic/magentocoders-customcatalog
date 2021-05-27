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

namespace MagentoCoders\CustomCatalog\Model;

use MagentoCoders\CustomCatalog\Api\Data\ProductInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Product
 * @package MagentoCoders\CustomCatalog\Model
 */
class Product extends AbstractModel implements ProductInterface
{

    /**
     * Initialize model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\MagentoCoders\CustomCatalog\Model\ResourceModel\Product::class);
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
     * Retrieve sku
     *
     * @return string
     */
    public function getSku()
    {
        return (string)$this->getData(self::SKU);
    }

    /**
     * Retrieve vpn
     *
     * @return string
     */
    public function getVpn()
    {
        return (string)$this->getData(self::VPN);
    }

    /**
     * Retrieve creation time
     *
     * @return string
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Retrieve update time
     *
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Set ProductID
     *
     * @param int $productId
     * @return ProductInterface
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * Set sku
     *
     * @param string $sku
     * @return ProductInterface
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * Set vpn
     *
     * @param string $vpn
     * @return ProductInterface
     */
    public function setVpn($vpn)
    {
        return $this->setData(self::VPN, $vpn);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return ProductInterface
     */
    public function setCreationTime($creationTime)
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return ProductInterface
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }
}
