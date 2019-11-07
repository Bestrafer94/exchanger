<?php

declare(strict_types=1);

namespace App\Tests\Gateway\Model;

use App\Gateway\Model\ExchangeRatesData;
use PHPUnit\Framework\TestCase;

class ExchangeRatesDataTest extends TestCase
{
    public function testCreate()
    {
        $targetCurrency = 'PHP';
        $baseCurrency = 'NOK';
        $date = 'latest';

        $data = (new ExchangeRatesData())
            ->setTargetCurrency($targetCurrency)
            ->setBaseCurrency($baseCurrency)
            ->setDate($date);

        $this->assertEquals($targetCurrency, $data->getTargetCurrency());
        $this->assertEquals($baseCurrency, $data->getBaseCurrency());
        $this->assertEquals($date, $data->getDate());
    }
}
