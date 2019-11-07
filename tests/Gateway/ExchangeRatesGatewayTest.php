<?php

declare(strict_types=1);

namespace App\Tests\Gateway\Response;

use App\Gateway\Client\ClientInterface;
use App\Gateway\ExchangeRatesGateway;
use App\Gateway\Model\ExchangeRatesData;
use App\Gateway\Response\ExchangeRateResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ExchangeRatesGatewayTest extends TestCase
{
    /**
     * @var ExchangeRatesGateway
     */
    private $gateway;

    /**
     * @var ClientInterface|MockObject
     */
    private $clientMock;

    /**
     * @var ExchangeRatesData|MockObject
     */
    private $exchangeRatesDataMock;

    protected function setUp(): void
    {
        $this->clientMock = $this->createMock(ClientInterface::class);
        $this->exchangeRatesDataMock = $this->createMock(ExchangeRatesData::class);

        $this->gateway = new ExchangeRatesGateway($this->clientMock);
    }

    public function testGetExchangeRates()
    {
        $responseMock = $this->createMock(ExchangeRateResponse::class);
        $this->clientMock->method('execute')->willReturn($responseMock);
        $response = $this->gateway->getExchangeRate($this->exchangeRatesDataMock);

        $this->assertEquals($responseMock, $response);
    }
}
