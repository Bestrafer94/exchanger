<?php

declare(strict_types=1);

namespace App\Provider\ExchangeRate;

interface ExchangeRateProviderInterface
{
    /**
     * @param string $baseCurrency
     * @param string $targetCurrency
     *
     * @return float
     */
    public function provide(string $baseCurrency, string $targetCurrency): float;
}
