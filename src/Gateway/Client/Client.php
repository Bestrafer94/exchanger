<?php

declare(strict_types=1);

namespace App\Gateway\Client;

use App\Gateway\Response\AbstractResponse;
use App\Gateway\Response\ResponseInterface;

class Client extends AbstractHttpClient
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $http;

    public function __construct(\GuzzleHttp\Client $httpClient)
    {
        $this->http = $httpClient;
    }

    /**
     * {@inheritdoc}
     */
    protected function buildErrorResponse(string $responseClass, \Exception $e): ResponseInterface
    {
        /** @var AbstractResponse $response */
        $response = new $responseClass();

        return $response;
    }
}
