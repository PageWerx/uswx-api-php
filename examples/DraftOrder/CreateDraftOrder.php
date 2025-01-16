<?php
/*
 * In this example, we will create a new DraftOrder using the USWerx API PHP SDK.
 * Before creating a DraftOrder, you must have a Site created and an API Token for that Site.
 * At a minimum, you will need to set the Token and Host for the Site in the Context Object's settings.
 * The Context Object is a Singleton and must be initialized before using the SDK.
 */

// We need to import the classes that we will be using in this script.
// This lets us use the DraftOrder class without needing to use the fully qualified namespace.
use Pagewerx\UswerxApiPhp\DraftOrder\DraftOrder;
use Pagewerx\UswerxApiPhp\UswerxApi;

// We need to require the Composer autoloader in our script, this pulls in dependencies like Guzzle and the USWerx API PHP SDK.
require_once __DIR__ . '/../../vendor/autoload.php';

// Determine if run from the CLI or HTTP
if (PHP_SAPI === 'cli')
{
    if (empty($argv[1])) {
        die("Please provide a list of SKUs (comma delimited) to add to the DraftOrder as the first argument.\n");
    } else {
        $skus = explode(',',$argv[1]);
        if(count($skus) < 1) {
            die("Please provide a list of SKUs (comma delimited) to add to the DraftOrder as the first argument.\n");
        }
    }
} else {
    $draftOrderId = $_GET['draftOrderId'];
}

// Initialize the API which inits/obtains the context singleton
$api = UswerxApi::init(); // We don't need to capture the API object to use the API, but there will be helper methods eventually.


try {
    // We will create a new DraftOrder using the DraftOrder classes create method and pass in a couple SKUs.
    $draftOrder = DraftOrder::create(['line_items'=>$skus]);
    echo "Draft order \"{$draftOrder->getName()}\" created with Shopify ID: {$draftOrder->getShopId()}\n";

    // We will output the DraftOrder's Invoice URL to the console.
    echo "Draft Order Invoice URL: {$draftOrder->getInvoiceUrl()}\n";
} catch (Exception $e) {
    // If an exception is thrown, we will output the exception message to the console.
    echo "Exception: " . $e->getMessage() . "\n";
}