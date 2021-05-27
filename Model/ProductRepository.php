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

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Store\Model\StoreManagerInterface;
use MagentoCoders\CustomCatalog\Api\ProductRepositoryInterface;
use MagentoCoders\CustomCatalog\Model\ResourceModel\Product as ProductModel;
use MagentoCoders\CustomCatalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use MagentoCoders\CustomCatalog\Model\ResourceModel\Relation\CollectionFactory as RelationCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use MagentoCoders\CustomCatalog\Api\Data\ProductSearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Reflection\DataObjectProcessor;
use MagentoCoders\CustomCatalog\Api\Data\ProductInterfaceFactory;
use Magento\Framework\Webapi\Rest\Request;

class ProductRepository implements ProductRepositoryInterface
{

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var Product
     */
    private $productModel;
    /**
     * @var \MagentoCoders\CustomCatalog\Model\ProductFactory
     */
    private $productFactory;
    /**
     * @var ProductSearchResultsInterfaceFactory
     */
    private $productSearchResultsInterfaceFactory;
    /**
     * @var ProductCollectionFactory
     */
    private $productCollectionFactory;
    /**
     * @var RelationCollectionFactory
     */
    private $relationCollectionFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;
    /**
     * @var DataObjectProcessor
     */
    private $objectProcessor;
    /**
     * @var ProductInterfaceFactory
     */
    private $productInterfaceFactory;
    /**
     * @var Request
     */
    private $requestBodyParams;

    public function __construct
    (
        StoreManagerInterface $storeManager,
        ProductModel $productModel,
        ProductFactory $productFactory,
        ProductCollectionFactory $productCollectionFactory,
        RelationCollectionFactory $relationCollectionFactory,
        ProductSearchResultsInterfaceFactory $productSearchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $objectProcessor,
        ProductInterfaceFactory $productInterfaceFactory,
        Request $requestBodyParams

    ) {
        $this->storeManager                         = $storeManager;
        $this->productModel                         = $productModel;
        $this->productFactory                       = $productFactory;
        $this->productSearchResultsInterfaceFactory = $productSearchResultsInterfaceFactory;
        $this->productCollectionFactory             = $productCollectionFactory;
        $this->relationCollectionFactory            = $relationCollectionFactory;
        $this->collectionProcessor                  = $collectionProcessor;
        $this->dataObjectHelper                     = $dataObjectHelper;
        $this->objectProcessor                      = $objectProcessor;
        $this->productInterfaceFactory              = $productInterfaceFactory;
        $this->requestBodyParams                    = $requestBodyParams;
    }

    /**
     * @inheritdoc
     */
    public function save(\MagentoCoders\CustomCatalog\Api\Data\ProductInterface $product)
    {
        try {
            $this->productModel->save($product);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $product;
    }

    /**
     * @inheritdoc
     */
    public function getById($productId)
    {
        $product = $this->productFactory->create();
        $this->productModel->load($product, $productId);

        if (!$product->getId()) {
            throw new NoSuchEntityException(__('The Product with the "%1" ID doesn\'t exist.', $productId));
        }
        return $product;
    }

    /**
     * @inheritdoc
     */
    public function getByVPN($vpn, \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->productCollectionFactory->create();
        $storeId = $this->storeManager->getStore()->getId();
        if($storeId == 1) {
            $storeId = 0;
        }
        $collection->addFieldToFilter('vpn',['eq' => $vpn]);
        $collection->getSelect()->joinLeft(
            ['cs'=> $collection->getTable('customcatalog_store')],
            'main_table.product_id= cs.product_id',
            ['copy_write_info' => 'cs.copy_write_info','store_id' => 'cs.store_id']
        )->where('cs.store_id='.$storeId);

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->productSearchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritdoc
     */
    public function getProductUpdate($productId)
    {
        $data = $this->requestBodyParams->getBodyParams();
        $vpn = $data['vpn'];

        if (!empty($data['store_id'])) {
            $storeId = $data['store_id'];
        } else {
            $data['store_id'] = 0;
        }
        $data['product_id'] = $productId;
        $copyWriteInfo = $data['copy_write_info'];
        $product = $this->productFactory->create();
        $product->load($productId);
        $product->setData($data);
        $product->save();
        return true;
    }

}
