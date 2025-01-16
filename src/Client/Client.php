<?php

namespace Pagewerx\UswerxApiPhp\Client;

use GuzzleHttp\Exception\GuzzleException;
use Pagewerx\UswerxApiPhp\Context;
use Pagewerx\UswerxApiPhp\Contracts\LoggerInterface;
use Pagewerx\UswerxApiPhp\DraftOrder\DraftOrder;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private string $token;
    private string $host;
    private bool $debug = false;
    private bool $test = false;
    private \GuzzleHttp\Client $httpClient;
    public LoggerInterface $logger;


    public function __construct()
    {
        $context = Context::getInstance();
        if (!$context->initialized()) {
            throw new \Exception('The context Singleton has not been initialized.');
        }

        $this->token = $context->getToken();
        $this->host = $context->getHost();
        $this->debug = $context->debugMode();
        $this->test = $context->testMode();
        $this->host = $context->getHost();
        $this->httpClient = $context->getClient();
        $this->logger = $context->getLogger();
    }

    public function enableDebug(): Client
    {
        $this->debug = true;
        return $this;
    }

    public function disableDebug(): Client
    {
        $this->debug = false;
        return $this;
    }

    public function debugEnabled()
    {
        return $this->debug;
    }

    /**
     * Retrieves the logger instance.
     *
     * @return LoggerInterface|null The logger instance or null if it is not set.
     */
    private function getLogger(): ?LoggerInterface
    {
        return $this->logger ?? null;
    }
    private function loggingEnabled(): bool
    {
        return !empty($this->getLogger());
    }

    private function debugLogEnabled(): bool
    {
        return $this->debug && $this->loggingEnabled();
    }

    private function debugLog($message, $context = []): void
    {
        if ($this->debugLogEnabled()) {
            $this->logger->debug($message, $context);
        }
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function post(string $endpoint, array $data)
    {
        try {
            $this->debugLog('Posting to '.$endpoint, $data);
            $response = $this->httpClient->post($endpoint, $data);
            $status = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            $this->debugLog('Response Received: ', [
                'HTTP_RESPONSE_CODE'=>$status,
                'RESPONSE_BODY'=>$body,
            ]);
            return $body;
        } catch (GuzzleException $e) {
            $this->debugLog('GuzzleException: '.$e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            $this->debugLog('Exception: '.$e->getMessage());
            throw $e;
        }
    }

    public function get(string $endpoint, array $array)
    {
        try {
            $this->debugLog('Getting from '.$endpoint, $array);
            $response = $this->httpClient->get($endpoint, $array);
            $status = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            $this->debugLog('Response Received: ', [
                'HTTP_RESPONSE_CODE'=>$status,
                'RESPONSE_BODY'=>$body,
            ]);
            return $body;
        } catch (GuzzleException $e) {
            $this->debugLog('GuzzleException: '.$e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            $this->debugLog('Exception: '.$e->getMessage());
            throw $e;
        }
    }
}