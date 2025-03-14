<?php
/*
 * In this example, we will retrieve a DraftOrder by its Shopify ID using the USWerx API PHP SDK.
 * Before retrieving a DraftOrder, you must have a Site created and an API Token for that Site.
 * At a minimum, you will need to set the Token and Host for the Site in the Context Object's settings.
 * The Context Object is a Singleton and must be initialized before using the SDK.
 */

// We need to require the Composer autoloader in our script, this pulls in dependencies like Guzzle and the USWerx API PHP SDK.
require_once __DIR__ . '/../../vendor/autoload.php';

// Load Config, environment variables, and helper functions
require_once __DIR__ . '/../../src/config.php';

if (PHP_SAPI === 'cli')
{
    if (empty($argv[1])) {
        echo "Please provide a Shopify Draft Order ID as the first argument.\n";
        exit;
    } else {
        $draftOrderId = $argv[1];
    }
} else {
    $draftOrderId = $_GET['draftOrderId'];
}

// We need to import the classes that we will be using in this script.
// This lets us use the DraftOrder class without needing to use the fully qualified namespace.
use Pagewerx\UswerxApiPhp\Context;
use Pagewerx\UswerxApiPhp\DraftOrder\DraftOrder;
use Pagewerx\UswerxApiPhp\Logging\DefaultLogger;
use Pagewerx\UswerxApiPhp\UswerxApi;
use Symfony\Component\Dotenv\Dotenv;

// Initialize the API which inits/obtains the context singleton
$api = UswerxApi::init(__DIR__ . '/../../.env'); // We don't need to capture the API object to use the API, but there will be helper methods eventually.


try {
    // We will retrieve a DraftOrder by its Shopify ID using the DraftOrder classes retrieve method.
    $draftOrder = DraftOrder::find($draftOrderId);
    echo "Draft order \"{$draftOrder->getName()}\" retrieved with Shopify ID: {$draftOrder->getShopId()}\n";

    // We will output the DraftOrder's Invoice URL to the console.
    echo "Draft Order Invoice URL: {$draftOrder->getInvoiceUrl()}\n\n\n";
    echo "Draft Order Data: \n";
    print_r($draftOrder->getDraftOrderData());
} catch (Exception $e) {
    // If an exception is thrown, we will output the exception message to the console.
    echo "Exception: " . $e->getMessage() . "\n";
}