<?php

declare(strict_types=1);

namespace App\Provider\ExchangeRate;

use App\Cache\ExchangeRateCache;
use App\Exception\ExchangeRatesNotFetchedException;
use App\Factory\ExchangeRatesDataFactory;
use App\Gateway\ExchangeRatesGateway;

class FromGateway extends ExchangeRateProvider
{
    /**
     * @var ExchangeRatesGateway
     */
    private $gateway;

    /**
     * @var ExchangeRatesDataFactory
     */
    private $exchangeRatesDataFactory;

    public function __construct(
        ExchangeRatesGateway $gateway,
        ExchangeRatesDataFactory $exchangeRatesDataFactory,
        ExchangeRateCache $cache
    ) {
        parent::__construct($cache);

        $this->gateway = $gateway;
        $this->exchangeRatesDataFactory = $exchangeRatesDataFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function processing(string $baseCurrency, string $targetCurrency): float
    {
        $response = $this->gateway->getExchangeRate(
            $this->exchangeRatesDataFactory->createForLatestExchangeRate($baseCurrency, $targetCurrency)
        );

        if (!$response->isSuccessful()) {
            throw new ExchangeRatesNotFetchedException($response->getErrorMessage());
        }

        $exchangeRate = $response->getRate();
        $this->cache->setExchangeRate($baseCurrency, $targetCurrency, $exchangeRate);

        return $exchangeRate;
    }
}
