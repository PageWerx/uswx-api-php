# USWerx API Integration Library

## Table of Contents

- [README](README.md) - (This Page) Project overview and getting started guide
- [DraftOrder](docs/DraftOrder.md) - Documentation for the DraftOrder class
- [Order](docs/Order.md) - Documentation for the Order class

---
## Install and Setup

1. **Require/Install the USWerx API Library for PHP using [Composer](https://getcomposer.org)**:
   ```bash
   composer require pagewerx/uswerx-api-php
   ```

2. **Set Environment Variables**

   Create a `.env` file (or use an existing one) and include the following necessary environment variables:
   ```
   USWX_API_TOKEN=<api-token>
   USWX_HOST=<host>
   ```
3. **Initialization**:

   To begin using the library you will first need to initialize it with the location of the `.env` file and optionally a
   `LoggerInterface` object. This will load your environment variables, set your logger to what was provided, if left null
   the `DefaultLogger` will be used. It is recommended to use a better logger than the provided `DefaultLogger` class.
   You can create your own using it as a reference or simply create a wrapper for an existing logging library.
   This process will get an instance of the API Library's Context Singleton.
   ```php
   UswerxApi::init(__DIR__ . '/path-to-your-env-file/.env');
   ```
---
