<?php


namespace MagentoCoders\CustomCatalog\Model;

use MagentoCoders\CustomCatalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use MagentoCoders\CustomCatalog\Model\ResourceModel\Relation\CollectionFactory as RelationCollectionFactory;

/**
 * Class DataProvider
 * @package MagentoCoders\CustomCatalog\Model
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;
    /**
     * @var RequestInterface
     */
    private $request;
    /**
     * @var RelationCollectionFactory
     */
    private $relationCollectionFactory;

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param RequestInterface $request
     * @param RelationCollectionFactory $relationCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        RequestInterface $request,
        RelationCollectionFactory $relationCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->request = $request;
        $this->relationCollectionFactory = $relationCollectionFactory;
    }

    /**
     * @return array
     */
    public function getData()
    {
        $storeId = $this->request->getParam('store');
        if($storeId == null)
        {
            $storeId = 0;
        }

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $product) {
           $copyWriteInfo = $this->getCopWriteInfo($product->getProductId(),$storeId);
             $product->setData('copy_write_info',$copyWriteInfo);
            $this->loadedData[$product->getProductId()] = $product->getData();
        }
        return $this->loadedData;
    }

    /**
     * @param $productId
     * @param $storeId
     * @return array
     */
   public function getCopWriteInfo($productId,$storeId)
    {
        $collection = $this->relationCollectionFactory->create();
        $collection->addFieldToFilter('product_id',['eq' => $productId])
            ->addFieldToFilter('store_id',['eq' => $storeId]);
        return $collection->getColumnValues('copy_write_info');
    }
}
