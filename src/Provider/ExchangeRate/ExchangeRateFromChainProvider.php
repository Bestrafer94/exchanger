<?php

declare(strict_types=1);

namespace App\Provider\ExchangeRate;

class ExchangeRateFromChainProvider implements ExchangeRateProviderInterface
{
    /**
     * @var FromCache
     */
    private $fromCache;

    /**
     * @var FromGateway
     */
    private $fromGateway;

    public function __construct(FromCache $fromCache, FromGateway $fromGateway)
    {
        $this->fromCache = $fromCache;
        $this->fromGateway = $fromGateway;
    }

    /**
     * {@inheritdoc}
     */
    public function provide(string $baseCurrency, string $targetCurrency): float
    {
        $this->fromCache->setNext($this->fromGateway);

        return $this->fromCache->provide($baseCurrency, $targetCurrency);
    }
}
