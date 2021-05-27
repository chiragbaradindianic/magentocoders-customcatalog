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

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\App\ResourceConnection;
use MagentoCoders\CustomCatalog\Api\Data\RelationInterface;

/**
 * Class Relation
 * @package MagentoCoders\CustomCatalog\Model
 */
class Relation extends AbstractModel implements RelationInterface
{
    /**
     * Initialize model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\MagentoCoders\CustomCatalog\Model\ResourceModel\Relation::class);
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
     * Retrieve Store Id
     *
     * @return int
     */
    public function getStoreId()
    {
        return $this->getData(self::STORE_ID);
    }

    /**
     * Retrieve Copywrite info Id
     *
     * @return string
     */
    public function getCopyWriteInfo()
    {
        return $this->getData(self::COPY_WRITE_INFO);
    }
    /**
     * Set ProductID
     *
     * @param int $productId
     * @return RelationInterface
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * Set StoreID
     *
     * @param int $storeId
     * @return RelationInterface
     */
    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * Set CopyWriteInfo
     *
     * @param string $copyWriteInfo
     * @return RelationInterface
     */
    public function setCopyWriteInfo($copyWriteInfo)
    {
        return $this->setData(self::COPY_WRITE_INFO, $copyWriteInfo);
    }
}
