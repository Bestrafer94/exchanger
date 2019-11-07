<?php

declare(strict_types=1);

namespace App\Factory;

use App\Gateway\Model\ExchangeRatesData;

class ExchangeRatesDataFactory
{
    const DEFAULT_DATE = 'latest';

    /**
     * @param string $baseCurrency
     * @param string $targetCurrency
     *
     * @return ExchangeRatesData
     */
    public function createForLatestExchangeRate(string $baseCurrency, string $targetCurrency): ExchangeRatesData
    {
        return (new ExchangeRatesData())
            ->setBaseCurrency($baseCurrency)
            ->setDate(self::DEFAULT_DATE)
            ->setTargetCurrency($targetCurrency);
    }
}
