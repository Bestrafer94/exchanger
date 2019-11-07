<?php

declare(strict_types=1);

namespace App\Tests\Provider;

use App\Cache\ExchangeRateCache;
use App\Exception\ExchangeRatesNotFetchedException;
use App\Factory\ExchangeRatesDataFactory;
use App\Gateway\ExchangeRatesGateway;
use App\Gateway\Response\ExchangeRateResponse;
use App\Provider\ExchangeRate\FromGateway;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FromGatewayTest extends TestCase
{
    /**
     * @var FromGateway
     */
    private $fromGateway;

    /**
     * @var ExchangeRatesGateway|MockObject
     */
    private $gatewayMock;

    /**
     * @var ExchangeRatesDataFactory|MockObject
     */
    private $exchangeRatesDataFactoryMock;

    /**
     * @var ExchangeRateCache|MockObject
     */
    private $exchangeRateCacheMock;

    /**
     * @var ExchangeRateResponse|MockObject
     */
    private $responseMock;

    protected function setUp(): void
    {
        $this->exchangeRateCacheMock = $this->createMock(ExchangeRateCache::class);
        $this->gatewayMock = $this->createMock(ExchangeRatesGateway::class);
        $this->exchangeRatesDataFactoryMock = $this->createMock(ExchangeRatesDataFactory::class);
        $this->responseMock = $this->createMock(ExchangeRateResponse::class);

        $this->fromGateway = new FromGateway(
            $this->gatewayMock,
            $this->exchangeRatesDataFactoryMock,
            $this->exchangeRateCacheMock
        );
    }

    public function testProcessingWithException()
    {
        $errorMessage = 'error';
        $this->gatewayMock->method('getExchangeRate')->willReturn($this->responseMock);
        $this->responseMock->method('isSuccessful')->willReturn(false);
        $this->responseMock->method('getErrorMessage')->willReturn($errorMessage);
        $this->expectException(ExchangeRatesNotFetchedException::class);
        $this->expectExceptionMessage($errorMessage);
        $this->exchangeRateCacheMock->expects($this->never())->method('setExchangeRate');

        $this->fromGateway->provide('EUR', 'PLN');
    }

    public function testProcessingSuccessful()
    {
        $expectedResult = 6.33;
        $this->gatewayMock->method('getExchangeRate')->willReturn($this->responseMock);
        $this->responseMock->method('isSuccessful')->willReturn(true);
        $this->responseMock->method('getRate')->willReturn($expectedResult);
        $this->exchangeRateCacheMock->expects($this->once())->method('setExchangeRate');

        $result = $this->fromGateway->provide('EUR', 'PLN');

        $this->assertEquals($expectedResult, $result);
    }
}
