# Order Class Reference

The `Order` class provides an interface for retrieving and managing completed orders in the `USWerx` processing system, which integrates with Shopify's e-commerce platform.

## Core Methods

### `findByDraftId`

```php
public static function findByDraftId($draftId): Order
```

Retrieves an existing order from the `USWerx` system using a Draft ID.

#### Parameters
- **`$draftId`**: The unique draft identifier of the order

#### Returns
- **`Order`**: An instance representing the found order

#### Example
```php
$order = Order::findByDraftId('DRAFT_123456');
```

### `findByShopifyId`

```php
public static function findByShopifyId($id): Order
```

Retrieves an existing order from the `USWerx` system using a Shopify ID.

#### Parameters
- **`$id`**: The Shopify order identifier

#### Returns
- **`Order`**: The found order object

#### Example
```php
$order = Order::findByShopifyId('9876543210');
```

## Instance Properties

| Property     | Description                                     |
|-------------|-------------------------------------------------|
| `$uswerxId`  | The USWerx ID for the order (private)           |
| `$Order`     | The raw order data                              |
| `$shopData`  | Shopify-specific data for the order             |
| `$shopId`    | The Shopify ID (private)                        |
| `$name`      | The order name in Shopify (private)             |
| `$context`   | The Context instance (private)                  |
| `$logger`    | The LoggerInterface implementation (private)    |
| `$client`    | The API Client instance (private)               |

## Instance Methods

To access order data, use the relevant properties after retrieving an order:

#### Example
```php
$order = Order::findByShopifyId('9876543210');

// Access order data
$orderData = $order->Order;
$shopifyData = $order->shopData;
```

## Exception Handling

Operations may throw exceptions for:
- Non-existent orders
- API communication failures
- Invalid context initialization
- System errors (network issues, internal `USWerx` problems)

## Integration Notes

- This class requires proper initialization of the `Context` class before use
- Order retrieval requires either a valid Draft ID or Shopify ID
- The client automatically handles authentication via Bearer token