# USWerx API PHP SDK

This repository demonstrates how to use the USWerx API PHP SDK for managing orders and draft orders. It provides simple examples for retrieving and creating orders.

---

## Prerequisites

1. **Setup**:
    - Create a `.env` file and include necessary environment variables:
      ```
      API_TOKEN=<your-api-token>
      API_HOST=<your-api-host>
      ```

2. **Install Dependencies**:
   ```bash
   composer install
   ```

3. **Initialization**:
    - All examples require calling:
      ```php
      UswerxApi::init(__DIR__ . '/path-to-your-env-file/.env');
      ```

---

## Example Scripts

### 1. Retrieve an Order by USWerx ID
Retrieve an order using its USWerx ID:
```bash
php GetOrderByUswerxId.php <uswerxOrderId>
```

### 2. Retrieve an Order by Shopify ID
Retrieve an order using its Shopify ID:
```bash
php GetOrderByShopifyId.php <shopifyOrderId>
```

### 3. Retrieve an Order by Draft Order's ID
Retrieve an order by its Draft Order's USWerx ID:
```bash
php GetOrderByDraftId.php <draftOrderId>
```

### 4. Create a New Draft Order
Create a new draft order using a list of SKUs:
```bash
php CreateDraftOrder.php "<comma-separated-skus>"
```

### 5. Retrieve a Draft Order by Shopify ID
Retrieve a draft order using its Shopify ID:
```bash
php GetDraftOrderById.php <shopifyDraftOrderId>
```

---

## Common Usage

### Initializing the SDK
Load `.env` configuration and initialize the SDK:
```php
UswerxApi::init(__DIR__ . '/path-to-env-file/.env');
```

### Example Workflow
Retrieve an order by USWerx ID:
```php
try {
    $order = Order::find($uswerxOrderId);
    print_r($order->getOrderData());
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

---

## Notes

- Always handle SDK calls with `try-catch` blocks for robust error handling.
- Use valid SKUs for creating draft orders.
- Scripts support both CLI and HTTP query parameter inputs.

---