<?php
/*
 * In this example, we will retrieve a DraftOrder by its Shopify ID using the USWerx API PHP SDK.
 * Before retrieving a DraftOrder, you must have a Site created and an API Token for that Site.
 * At a minimum, you will need to set the Token and Host for the Site in the Context Object's settings.
 * The Context Object is a Singleton and must be initialized before using the SDK.
 */

// We need to require the Composer autoloader in our script, this pulls in dependencies like Guzzle and the USWerx API PHP SDK.
require_once __DIR__ . '/../../vendor/autoload.php';

// We need to require the config.php file in our script, this sets the API Host and Token for the Site.
require_once __DIR__ . '/../config.php';

// We need to import the classes that we will be using in this script.
// This lets us use the DraftOrder class without needing to use the fully qualified namespace.
use Pagewerx\UswerxApiPhp\Context;
use Pagewerx\UswerxApiPhp\DraftOrder\DraftOrder;
use Pagewerx\UswerxApiPhp\Logging\DefaultLogger;

// We need to initialize the Context Singleton with the Token and Host for the Site. We will also use the DefaultLogger.
$context = Context::getInstance()->settings(
    API_TOKEN,
    API_HOST,
    new DefaultLogger(),
    true,
    false,
    null
);

try {
    // We will retrieve a DraftOrder by its Shopify ID using the DraftOrder classes retrieve method.
    $draftOrder = DraftOrder::find(DRAFT_ORDER_ID);
    echo "Draft order \"{$draftOrder->getName()}\" retrieved with Shopify ID: {$draftOrder->getShopId()}\n";

    // We will output the DraftOrder's Invoice URL to the console.
    echo "Draft Order Invoice URL: {$draftOrder->getInvoiceUrl()}\n\n\n";
    echo "Draft Order Data: \n";
    print_r($draftOrder->getDraftOrderData());
} catch (Exception $e) {
    // If an exception is thrown, we will output the exception message to the console.
    echo "Exception: " . $e->getMessage() . "\n";
}