<?php
/**
 * Retrieve an Order by its USWerx ID using the USWerx API PHP SDK.
 *
 * Prerequisites:
 * - Ensure you have created a Site and obtained an API Token for that Site.
 * - Set the Token and Host via the Context Object's settings.
 * - The Context Object is a Singleton and must be initialized before using the SDK.
 */

// Autoload dependencies (e.g., Guzzle, USWerx API PHP SDK)
require_once __DIR__ . '/../../vendor/autoload.php';

// Load configuration or environment variables
require_once __DIR__ . '/../../src/config.php';

use Pagewerx\UswerxApiPhp\UswerxApi;
use Pagewerx\UswerxApiPhp\Order\Order;

// Determine how to get the USWerx Order ID (CLI or HTTP GET)
if (PHP_SAPI === 'cli') {
    // For CLI usage
    if (empty($argv[1])) {
        echo "Please provide a USWerx Order ID as the first argument.\n";
        exit(1);
    }
    $uswerxOrderId = $argv[1];
} else {
    // For HTTP usage
    if (empty($_GET['uswerxOrderId'])) {
        echo "Please provide a USWerx Order ID as a 'uswerxOrderId' query parameter.\n";
        exit(1);
    }
    $uswerxOrderId = $_GET['uswerxOrderId'];
}

try {
    // Initialize the SDK
    UswerxApi::init(__DIR__ . '/../../.env'); // Loads environment variables from .env file

    // Retrieve the Order by USWerx ID
    $order = Order::find($uswerxOrderId);

    // Output the Order details
    echo "Order ID: {$order->getUswerxId()} retrieved successfully.\n";
    echo "Order Data: \n";
    print_r($order->getOrderData());
} catch (Exception $e) {
    // Handle any errors
    echo "Error: {$e->getMessage()}\n";
}