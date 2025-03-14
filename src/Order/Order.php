<?php

namespace Pagewerx\UswerxApiPhp\Order;

use Exception;
use GuzzleHttp\Psr7\Response;
use Pagewerx\UswerxApiPhp\Client\Client;
use Pagewerx\UswerxApiPhp\Context;
use Pagewerx\UswerxApiPhp\Contracts\LoggerInterface;

class Order
{
    private $uswerxId;
    public $Order;
    public $shopData;
    private $shopId;
    private $name;
    private Context $context;
    private LoggerInterface $logger;
    private Client $client;

    /**
     * Order constructor.
     *
     * @param array $data The data to be used to create the Order object.
     * @throws Exception
     */
    public function __construct() {}

    
    public static function findByDraftId($draftId): Order
    {

        $order = new self();
        $order->client = new Client(); // Throws an exception if Context is not initialized.
        $order->context = Context::getInstance();
        $order->logger = $order->context->getLogger();
        $order->logger->debug('Attempting to fetch Order by Draft ID.');

        $endpoint = $order->client->getHost() . '/api/orders/draft/' . $draftId;
        $headers = [
            'Authorization' => 'Bearer ' . $order->client->getToken(),
            'Content-Type' => 'application/json',
        ];

        $response = $order->client->get($endpoint, [
            'headers' => $headers,
        ]);

        $dataLog = "Response is a: ";
        /**
         * @codeCoverageIgnore
         */
        if ($response instanceof Response) {
            $dataLog .= "Guzzle Response object";
        } else {
            $dataLog .= gettype($response);
        }
        $order->logger->debug($dataLog);

        $responseObj = json_decode($response, false);
        $order->logger->debug('Order fetched successfully', [
            'api_response_string' => $response,
            'api_response_object' => $responseObj,
        ]);

        $order->Order = $responseObj;

        if (!empty($responseObj->data->shop_data)) {
            $order->shopData = $responseObj->data->shop_data;
            $order->shopId = $order->shopData->id ?? null;
            $order->name = $order->shopData->name ?? null;
        }

        $order->uswerxId = $responseObj->data->id ?? null;

        return $order;
    }
    /**
     * Finds an order by its ID.
     *
     * @param int|string $id The ID of the order to retrieve.
     * @throws Exception
     * @return Order
     */
    
    public static function findByShopifyId($id): Order
    {
        $order = new self();
        $order->client = new Client(); // Throws an exception if Context is not initialized.
        $order->context = Context::getInstance();
        $order->logger = $order->context->getLogger();
        $order->logger->debug('Attempting to fetch Order by Shopify ID.');

        $endpoint = $order->client->getHost() . '/api/orders/shopify/' . $id;
        $headers = [
            'Authorization' => 'Bearer ' . $order->client->getToken(),
            'Content-Type' => 'application/json',
        ];

        $response = $order->client->get($endpoint, [
            'headers' => $headers,
        ]);

        $dataLog = "Response is a: ";
        /**
         * @codeCoverageIgnore
         */
        if ($response instanceof Response) {
            $dataLog .= "Guzzle Response object";
        } else {
            $dataLog .= gettype($response);
        }
        $order->logger->debug($dataLog);

        $responseObj = json_decode($response, false);
        $order->logger->debug('Order fetched successfully', [
            'api_response_string' => $response,
            'api_response_object' => $responseObj,
        ]);

        $order->Order = $responseObj;

        if (!empty($responseObj->data->shop_data)) {
            $order->shopData = $responseObj->data->shop_data;
            $order->shopId = $order->shopData->id ?? null;
            $order->name = $order->shopData->name ?? null;
        }

        $order->uswerxId = $responseObj->data->id ?? null;

        return $order;
    }
    public static function find($id): Order
    {
        $order = new self();
        $order->client = new Client(); // Throws an exception if Context is not initialized.
        $order->context = Context::getInstance();
        $order->logger = $order->context->getLogger();
        $order->logger->debug('Attempting to fetch Order by ID.');

        $endpoint = $order->client->getHost() . '/api/orders/' . $id;
        $headers = [
            'Authorization' => 'Bearer ' . $order->client->getToken(),
            'Content-Type' => 'application/json',
        ];

        $response = $order->client->get($endpoint, [
            'headers' => $headers,
        ]);

        $dataLog = "Response is a: ";
        /**
         * @codeCoverageIgnore
         */
        if ($response instanceof Response) {
            $dataLog .= "Guzzle Response object";
        } else {
            $dataLog .= gettype($response);
        }
        $order->logger->debug($dataLog);

        $responseObj = json_decode($response, false);
        $order->logger->debug('Order fetched successfully', [
            'api_response_string' => $response,
            'api_response_object' => $responseObj,
        ]);

        $order->Order = $responseObj;

        if (!empty($responseObj->data->shop_data)) {
            $order->shopData = $responseObj->data->shop_data;
            $order->shopId = $order->shopData->id ?? null;
            $order->name = $order->shopData->name ?? null;
        }

        $order->uswerxId = $responseObj->data->id ?? null;

        return $order;
    }

    /**
     * Gets the raw order data.
     *
     * @return object|null
     */
    public function getOrderData(): ?object
    {
        return $this->Order;
    }

    /**
     * Gets the Shopify data associated with the order.
     *
     * @return object|null
     */
    public function getShopData(): ?object
    {
        return $this->shopData;
    }

    /**
     * Gets the Shopify shop ID for the order.
     *
     * @return int|null
     */
    public function getShopId(): ?int
    {
        return $this->shopId;
    }

    public function getUswerxId(): ?int
    {
        return $this->uswerxId;
    }

    /**
     * Gets the name of the Shopify shop for the order.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}