<?php

namespace App\Gateway\Client;

use App\Gateway\Request\RequestInterface;
use App\Gateway\Response\ResponseInterface;

interface ClientInterface
{
    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function execute(RequestInterface $request): ResponseInterface;
}
