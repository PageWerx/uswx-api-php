# DraftOrder Class Reference

The `DraftOrder` class provides an interface for managing orders in the `USWerx` processing system, which integrates with Shopify's e-commerce platform.

## Core Methods

### `create`

```php
public static function create(array $data): DraftOrder
```

Creates a new draft order in the `USWerx` system.

#### Parameters
- **`array $data`**: An associative array containing:
    - **`line_items`** *(array|string)*: Required. Products to include in the order as:
        - An array of SKUs: `['PRODUCT_123', 'PRODUCT_456']`
        - A comma-separated string: `'PRODUCT_123,PRODUCT_456'`
    - Additional optional attributes as needed (tags, pricing adjustments, etc.)

#### Returns
- **`DraftOrder`**: An instance representing the newly created order

#### Example
```php
$draftOrder = DraftOrder::create([
    'line_items' => ['PRODUCT_001', 'PRODUCT_002']
]);
```

### `find`

```php
public static function find($id): ?DraftOrder
```

Retrieves an existing draft order from the `USWerx` system.

#### Parameters
- **`$id`**: The unique identifier of the draft order

#### Returns
- **`DraftOrder`**: The found order object
- **`null`**: If no matching order exists

#### Example
```php
$draftOrder = DraftOrder::find('ORDER_987654321');
```

## Instance Methods

| Method              | Description                                     |
|---------------------|-------------------------------------------------|
| `getShopId`         | Returns the Shopify ID                          |
| `getUswerxId`       | Returns the USWerx ID                           |
| `getName`           | Returns the order name in Shopify               |
| `getDraftOrderData` | Returns the complete order data                 |
| `getInvoiceUrl`     | Returns the Shopify invoice URL                 |
| `getLineItems`      | Returns the order line items                    |

#### Example
```php
$draftOrder = DraftOrder::create([
    'line_items' => ['PRODUCT_001', 'PRODUCT_002']
]);

// Access instance methods
$shopifyId = $draftOrder->getShopId();
$uswerxId = $draftOrder->getUswerxId();
$orderName = $draftOrder->getName();
$orderData = $draftOrder->getDraftOrderData();
$invoiceUrl = $draftOrder->getInvoiceUrl();
$lineItems = $draftOrder->getLineItems();
```
## Exception Handling

Operations may throw exceptions for:
- Invalid input (e.g., missing required fields)
- Non-existent orders
- System errors (network issues, internal `USWerx` problems)

## Integration Notes

- At minimum, `line_items` must be provided when creating draft orders
- Product identifiers must match your system's SKU format