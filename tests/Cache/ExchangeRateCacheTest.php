<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Cache\CacheStorageInterface;
use App\Cache\ExchangeRateCache;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ExchangeRateCacheTest extends TestCase
{
    /**
     * @var ExchangeRateCache
     */
    private $exchangeRateCache;

    /**
     * @var CacheStorageInterface|MockObject
     */
    private $cacheStorageMock;

    protected function setUp(): void
    {
        $this->cacheStorageMock = $this->createMock(CacheStorageInterface::class);
        $this->exchangeRateCache = new ExchangeRateCache(
            $this->cacheStorageMock
        );
    }

    public function testGetExchangeRate()
    {
        $result = 0.25;
        $this->cacheStorageMock->method('get')->willReturn($result);
        $this->cacheStorageMock->method('has')->willReturn(true);

        $exchangeRate = $this->exchangeRateCache->getExchangeRate('EUR', 'PLN');

        $this->assertEquals($result, $exchangeRate);
    }

    public function testGetExchangeRateForNoValueInCacheStorage()
    {
        $this->cacheStorageMock->method('has')->willReturn(false);

        $exchangeRate = $this->exchangeRateCache->getExchangeRate('EUR', 'PLN');

        $this->assertNull($exchangeRate);
    }

    public function testSetExchangeRate()
    {
        $this->cacheStorageMock->expects($this->once())->method('set');
        $this->exchangeRateCache->setExchangeRate('EUR', 'PLN', 0.27);
    }
}
