<?php

declare(strict_types=1);

namespace App\Tests\Provider;

use App\Cache\ExchangeRateCache;
use App\Provider\ExchangeRate\FromCache;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FromCacheTest extends TestCase
{
    /**
     * @var FromCache
     */
    private $fromCache;

    /**
     * @var ExchangeRateCache|MockObject
     */
    private $exchangeRateCacheMock;

    protected function setUp(): void
    {
        $this->exchangeRateCacheMock = $this->createMock(ExchangeRateCache::class);

        $this->fromCache = new FromCache($this->exchangeRateCacheMock);
    }

    public function testProcessingSuccessful()
    {
        $expectedResult = 3.14;
        $baseCurrency = 'EUR';
        $targetCurrency = 'PLN';
        $this->exchangeRateCacheMock
            ->method('getExchangeRate')
            ->with($baseCurrency, $targetCurrency)
            ->willReturn($expectedResult);

        $result = $this->fromCache->provide($baseCurrency, $targetCurrency);
        $this->assertEquals($expectedResult, $result);

    }

    public function testProcessingFailure()
    {
        $baseCurrency = 'EUR';
        $targetCurrency = 'PLN';
        $this->exchangeRateCacheMock
            ->method('getExchangeRate')
            ->with($baseCurrency, $targetCurrency)
            ->willReturn(null);

        $result = $this->fromCache->provide($baseCurrency, $targetCurrency);

        $this->assertNull($result);
    }
}
