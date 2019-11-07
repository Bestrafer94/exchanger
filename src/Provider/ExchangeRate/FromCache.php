<?php

declare(strict_types=1);

namespace App\Provider\ExchangeRate;

class FromCache extends ExchangeRateProvider
{
    /**
     * {@inheritdoc}
     */
    public function processing(string $baseCurrency, string $targetCurrency): ?float
    {
        return $this->cache->getExchangeRate($baseCurrency, $targetCurrency) ?? null;
    }
}
