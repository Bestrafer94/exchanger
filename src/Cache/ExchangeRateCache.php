<?php

declare(strict_types=1);

namespace App\Cache;

class ExchangeRateCache
{
    private const KEY_PREFIX = 'exchange-rate';
    private const EXPIRATION_TIME_IN_SECONDS = 3000;

    /**
     * @var CacheStorageInterface
     */
    protected $cacheStorage;

    public function __construct(CacheStorageInterface $cacheStorage)
    {
        $this->cacheStorage = $cacheStorage;
    }

    /**
     * @param string $baseCurrency
     * @param string $targetCurrency
     *
     * @return float|null
     */
    public function getExchangeRate(string $baseCurrency, string $targetCurrency): ?float
    {
        $key = $this->getKey($baseCurrency, $targetCurrency);

        return $this->cacheStorage->has($key)
            ? (float) $this->cacheStorage->get($key)
            : null;
    }

    /**
     * @param string $baseCurrency
     * @param string $targetCurrency
     *
     * @param float $exchangeRate
     */
    public function setExchangeRate(string $baseCurrency, string $targetCurrency, float $exchangeRate)
    {
        $this->cacheStorage->set(
            $this->getKey($baseCurrency, $targetCurrency),
            $exchangeRate,
            self::EXPIRATION_TIME_IN_SECONDS
        );
    }

    /**
     * @param string $base
     * @param string $target
     *
     * @return string
     */
    private function getKey(string $base, string $target): string
    {
        return sprintf(
            '%s-base-%s-target-%s-date-%s',
            self::KEY_PREFIX,
            $base,
            $target,
            (new \DateTime())->format('Y-m-d')
        );
    }
}
