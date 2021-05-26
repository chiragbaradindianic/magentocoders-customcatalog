<?php
namespace MagentoCoders\CustomCatalog\Model;

use Magento\AsynchronousOperations\Api\Data\OperationInterface;
use Magento\Framework\DB\Adapter\ConnectionException;
use Magento\Framework\DB\Adapter\DeadlockException;
use Magento\Framework\DB\Adapter\LockWaitException;
use Magento\Framework\Exception\TemporaryStateExceptionInterface;
use Magento\Framework\HTTP\PhpEnvironment\Request as ClientIpRequest;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Json\Helper\Data;
use Magento\Framework\Bulk\OperationManagementInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Serialize\Serializer\Json;
use MagentoCoders\CustomCatalog\Model\ProductRepository;

/**
 * Class Consumer
 * @package MagentoCoders\CustomCatalog\Model
 */
class Consumer
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Data
     */
    private $jsonHelper;

    /**
     * @var OperationManagementInterface
     */
    private $operationManagement;

    /**
     * @var ApiLog
     */
    private $apiLog;

    /**
     * @var ClientIpRequest
     */
    private $clientIpRequest;

    /**
     * @var Curl
     */
    private $curl;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var WatchFactory
     */
    private $watchFactory;

    /**
     * @var Json
     */
    private $serializer;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * Consumer constructor.
     * @param LoggerInterface $logger
     * @param Data $jsonHelper
     * @param OperationManagementInterface $operationManagement
     * @param ApiLog $apiLog
     * @param ClientIpRequest $clientIpRequest
     * @param Curl $curl
     * @param ScopeConfigInterface $scopeConfig
     * @param Json $serializer
     * @param ProductRepository $productRepository
     */
    public function __construct
    (
        LoggerInterface $logger,
        Data $jsonHelper,
        OperationManagementInterface $operationManagement,
        ApiLog $apiLog,
        ClientIpRequest $clientIpRequest,
        Curl $curl,
        ScopeConfigInterface $scopeConfig,
        Json $serializer,
        ProductRepository $productRepository
    ) {
        $this->logger               = $logger;
        $this->jsonHelper           = $jsonHelper;
        $this->operationManagement  = $operationManagement;
        $this->apiLog               = $apiLog;
        $this->clientIpRequest      = $clientIpRequest;
        $this->curl                 = $curl;
        $this->scopeConfig          = $scopeConfig;
        $this->serializer           = $serializer;
        $this->productRepository    = $productRepository;
    }

    /**
     * @param OperationInterface $operation
     */
    public function process(OperationInterface $operation)
    {
        $status = OperationInterface::STATUS_TYPE_COMPLETE;
        $errorCode = null;
        $message = null;
        $serializedData = $operation->getSerializedData();
        $unserializedData = $this->jsonHelper->jsonDecode($serializedData);
        try {
            $this->execute($unserializedData);
        } catch (\Zend_Db_Adapter_Exception  $e) {
            //here sample how to process exceptions if they occurred
            $this->logger->critical($e->getMessage());
            //you can add here your own type of exception when operation can be retried
            if (
                $e instanceof LockWaitException
                || $e instanceof DeadlockException
                || $e instanceof ConnectionException
            ) {
                $status = OperationInterface::STATUS_TYPE_RETRIABLY_FAILED;
                $errorCode = $e->getCode();
                $message = __($e->getMessage());
            } else {
                $status = OperationInterface::STATUS_TYPE_NOT_RETRIABLY_FAILED;
                $errorCode = $e->getCode();
                $message = __('Sorry, something went wrong during product prices update. Please see log for details.');
            }
        } catch (NoSuchEntityException $e) {
            $this->logger->critical($e->getMessage());
            $status = ($e instanceof TemporaryStateExceptionInterface) ? OperationInterface::STATUS_TYPE_NOT_RETRIABLY_FAILED : OperationInterface::STATUS_TYPE_NOT_RETRIABLY_FAILED;
            $errorCode = $e->getCode();

            $message = $e->getMessage();
            unset($unserializedData['entity_link']);
            $serializedData = $this->jsonHelper->jsonEncode($unserializedData);
        } catch (LocalizedException $e) {
            $this->logger->critical($e->getMessage());
            $status = OperationInterface::STATUS_TYPE_NOT_RETRIABLY_FAILED;
            $errorCode = $e->getCode();
            $message = $e->getMessage();
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            $status = OperationInterface::STATUS_TYPE_NOT_RETRIABLY_FAILED;
            $errorCode = $e->getCode();
            $message = __('Sorry, something went wrong during product prices update. Please see log for details.');
        }

        //update operation status based on result performing operation(it was successfully executed or exception occurs
        $this->operationManagement->changeOperationStatus(
            $operation->getId(),
            $status,
            $errorCode,
            $message,
            $serializedData
        );
    }

    /**
     * @param $data
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function execute($data)
    {
        if ($data && isset($data['product_id']) && isset($data['sku']) && isset($data['store_id'])) {
            $this->productRepository->getById($data['product_id']);
        }
        else {
            $this->logger->info("We can\'t find proper data from RabbitMQ");
            $this->logger->info(print_r($data, true));
        }
    }
}
