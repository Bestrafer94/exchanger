<?php

declare(strict_types=1);

namespace App\Provider\ExchangeRate;

use App\Cache\ExchangeRateCache;

abstract class ExchangeRateProvider
{
    /**
     * @var ExchangeRateCache
     */
    protected $cache;

    /**
     * @var ExchangeRateProvider|null
     */
    private $nextProvider = null;

    public function __construct(ExchangeRateCache $cache)
    {
        $this->cache = $cache;
    }

    final public function provide(string $baseCurrency, string $targetCurrency): ?float
    {
        $processed = $this->processing($baseCurrency, $targetCurrency);

        if (null === $processed && null !== $this->getProvider()) {
            $processed = $this->getProvider()->provide($baseCurrency, $targetCurrency);
        }

        return $processed;
    }

    /**
     * @param ExchangeRateProvider $exchangeRateProvider
     */
    public function setNext(ExchangeRateProvider $exchangeRateProvider)
    {
        $this->nextProvider = $exchangeRateProvider;
    }

    /**
     * @return ExchangeRateProvider|null
     */
    public function getProvider(): ?ExchangeRateProvider
    {
        return $this->nextProvider;
    }

    /**
     * @param string $baseCurrency
     * @param string $targetCurrency
     *
     * @return float|null
     */
    abstract protected function processing(string $baseCurrency, string $targetCurrency): ?float;
}
