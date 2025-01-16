<?php
namespace Pagewerx\UswerxApiPhp;

use Pagewerx\UswerxApiPhp\Contracts\LoggerInterface;
use Pagewerx\UswerxApiPhp\Logging\DefaultLogger;
use Symfony\Component\Dotenv\Dotenv;

class UswerxApi
{
    protected Dotenv $dotEnv;
    protected string $envFile;
    protected Context $context;
    public function __construct($envFile = __DIR__ . '/../.env', LoggerInterface $logger = null) {
        require_once 'config.php';
        $this->envFile = $envFile;
        $logger = $logger ?? new DefaultLogger();
        try {
            $this->dotEnv = new Dotenv();
            $this->dotEnv->load($this->envFile);

            // We need to initialize the Context Singleton with the Token and Host for the Site. We will also use the DefaultLogger.
            $this->context = Context::getInstance()->settings(
                $_ENV['USWX_API_TOKEN'] ?? null,
                $_ENV['USWX_HOST'] ?? null,
                $logger,
                true,
                false,
                null
            );
        } catch (\Exception $e) {
            echo "Error: {$e->getMessage()}\n";
        }
    }

    public static function init($envFile = __DIR__ . '/../.env', LoggerInterface $logger = null) {
        return new self($envFile, $logger);
    }
}