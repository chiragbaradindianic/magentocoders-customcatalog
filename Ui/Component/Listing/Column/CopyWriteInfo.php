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

namespace MagentoCoders\CustomCatalog\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use MagentoCoders\CustomCatalog\Model\ResourceModel\Relation\CollectionFactory;

/**
 * Class CopyWriteInfo
 * @package MagentoCoders\CustomCatalog\Ui\Component\Listing\Column
 */
class CopyWriteInfo extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var Relation
     */
    private $relation;

    /**
     * CopyWriteInfo constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param CollectionFactory $relation
     * @param array $components
     * @param array $data
     */
    public function __construct
    (
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        CollectionFactory $relation,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->relation = $relation;
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item['copy_write_info'] = $this->getCopyWriteInfo($item['product_id']);
            }
        }

        return $dataSource;
    }

    /**
     * @param $productId
     * @return array
     */
    public function getCopyWriteInfo($productId)
    {
        $collection = $this->relation->create();
        $collection
            ->addFieldToFilter('product_id', ['eq' => $productId])
            ->addFieldToFilter('store_id', ['eq' => '0']);
        return $collection->getColumnValues('copy_write_info');
    }
}
