<?php

declare(strict_types=1);

namespace App\Tests\Provider;

use App\Provider\ExchangeRate\ExchangeRateFromChainProvider;
use App\Provider\ExchangeRate\FromCache;
use App\Provider\ExchangeRate\FromGateway;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ExchangeRateFromChainProviderTest extends TestCase
{
    /**
     * @var ExchangeRateFromChainProvider
     */
    private $provider;

    /**
     * @var FromCache|MockObject
     */
    private $fromCacheMock;

    /**
     * @var FromGateway|MockObject
     */
    private $fromGatewayMock;

    protected function setUp(): void
    {
        $this->fromCacheMock = $this->createMock(FromCache::class);
        $this->fromGatewayMock = $this->createMock(FromGateway::class);

        $this->provider = new ExchangeRateFromChainProvider(
            $this->fromCacheMock,
            $this->fromGatewayMock
        );
    }

    public function testProvideFromCache()
    {
        $expectedResult = 2.14;
        $this->fromCacheMock->method('processing')->willReturn($expectedResult);
        $exchangeRate = $this->provider->provide('EUR', 'USD');

        $this->assertEquals($expectedResult, $exchangeRate);
    }

    public function testProvideFromGateway()
    {
        $expectedResult = 2.14;
        $this->fromCacheMock->setNext($this->fromGatewayMock);
        $this->fromCacheMock->method('processing')->willReturn(null);
        $this->fromCacheMock->method('getProvider')->willReturn($this->fromGatewayMock);
        $this->fromGatewayMock->method('processing')->willReturn($expectedResult);
        $exchangeRate = $this->provider->provide('EUR', 'USD');

        $this->assertEquals($expectedResult, $exchangeRate);
    }
}
