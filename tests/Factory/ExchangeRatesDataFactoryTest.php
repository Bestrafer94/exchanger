<?php

declare(strict_types=1);

namespace App\Tests\Factory;

use App\Dictionary\Currency;
use App\Factory\ExchangeRatesDataFactory;
use PHPUnit\Framework\TestCase;

class ExchangeRatesDataFactoryTest extends TestCase
{
    public function testCreate()
    {
        $baseCurrency = Currency::DANISH_KRONE;
        $targetCurrency = Currency::BRAZILIAN_REAL;

        $factory = new ExchangeRatesDataFactory();

        $data = $factory->createForLatestExchangeRate($baseCurrency, $targetCurrency);

        $this->assertEquals($baseCurrency, $data->getBaseCurrency());
        $this->assertEquals($targetCurrency, $data->getTargetCurrency());
        $this->assertEquals(ExchangeRatesDataFactory::DEFAULT_DATE, $data->getDate());
    }
}
