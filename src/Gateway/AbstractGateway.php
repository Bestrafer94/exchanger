<?php

declare(strict_types=1);

namespace App\Gateway;

use App\Gateway\Client\ClientInterface;

abstract class AbstractGateway
{
    /**
     * @var ClientInterface
     */
    protected $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}
