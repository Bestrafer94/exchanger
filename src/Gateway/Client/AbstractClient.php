<?php

declare(strict_types=1);

namespace App\Gateway\Client;

use App\Gateway\Request\RequestInterface;
use App\Gateway\Response\ResponseInterface;

abstract class AbstractClient implements ClientInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(RequestInterface $request): ResponseInterface
    {
        $response = $this->sendRequest($request);

        return $response;
    }

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    abstract protected function sendRequest(RequestInterface $request): ResponseInterface;
}
