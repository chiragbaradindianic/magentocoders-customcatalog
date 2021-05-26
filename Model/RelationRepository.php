<?php
namespace MagentoCoders\CustomCatalog\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use MagentoCoders\CustomCatalog\Api\RelationRepositoryInterface;
use MagentoCoders\CustomCatalog\Model\ResourceModel\Relation as RelationModel;

/**
 * Class RelationRepository
 * @package MagentoCoders\CustomCatalog\Model
 */
class RelationRepository implements RelationRepositoryInterface
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var \MagentoCoders\CustomCatalog\Model\RelationFactory
     */
    private $relationFactory;
    /**
     * @var RelationModel
     */
    private $relationModel;

    /**
     * RelationRepository constructor.
     * @param StoreManagerInterface $storeManager
     * @param RelationModel $relationModel
     * @param RelationFactory $relationFactory
     */
    public function __construct
    (
        StoreManagerInterface $storeManager,
        RelationModel $relationModel,
        RelationFactory $relationFactory

    ) {
        $this->storeManager     = $storeManager;
        $this->relationFactory  = $relationFactory;
        $this->relationModel    = $relationModel;
    }

    /**
     * @param \MagentoCoders\CustomCatalog\Api\Data\RelationInterface $product
     * @return \MagentoCoders\CustomCatalog\Api\Data\RelationInterface|\MagentoCoders\CustomCatalog\Api\MagentoCoders\CustomCatalog\Api\Data\RelationInterface
     */
    public function save(\MagentoCoders\CustomCatalog\Api\Data\RelationInterface $product)
    {
        try {
            $this->relationModel->save($product);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $product;
    }

    /**
     * @param string $productId
     * @return \MagentoCoders\CustomCatalog\Api\MagentoCoders\CustomCatalog\Api\Data\RelationInterface
     * @throws NoSuchEntityException
     */
    public function getById($productId)
    {
        $product = $this->relationFactory->create();
        $this->relationModel->load($product, $productId);

        if (!$product->getProductId()) {
            throw new NoSuchEntityException(__('The Product with the "%1" ID doesn\'t exist.', $productId));
        }
        return $product;
    }
}
