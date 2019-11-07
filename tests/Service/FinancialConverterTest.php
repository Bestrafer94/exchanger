<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\FinancialConverter;
use PHPUnit\Framework\TestCase;

class FinancialConverterTest extends TestCase
{
    /**
     * @var FinancialConverter
     */
    private $financialConverter;


    protected function setUp(): void
    {
        $this->financialConverter = new FinancialConverter();
    }

    public function testCalculateTargetAmount()
    {
        $baseAmount = 123.21;
        $exchangeRate = 2.0938;
        $expectedResult = 25798;

        $result = $this->financialConverter->calculateTargetAmount($baseAmount, $exchangeRate);

        $this->assertEquals($expectedResult, $result);
    }

    public function testAmountToDatabaseConverter()
    {
        $amount = 123.214;
        $expectedResult = 12321;

        $result = $this->financialConverter->amountToDatabaseConverter($amount);

        $this->assertEquals($expectedResult, $result);
    }

    public function testAmountFromDatabaseConverter()
    {
        $amount = 12321;
        $expectedResult = 123.21;

        $result = $this->financialConverter->amountFromDatabaseConverter($amount);

        $this->assertEquals($expectedResult, $result);
    }

    public function testExchangeRateToDatabaseConverter()
    {
        $exchangeRate = 0.91;
        $expectedResult = 91000;

        $result = $this->financialConverter->exchangeRateToDatabaseConverter($exchangeRate);

        $this->assertEquals($expectedResult, $result);
    }

    public function testExchangeRateFromDatabaseConverter()
    {
        $exchangeRate = 91000;
        $expectedResult = 0.91;

        $result = $this->financialConverter->exchangeRateFromDatabaseConverter($exchangeRate);

        $this->assertEquals($expectedResult, $result);
    }
}
