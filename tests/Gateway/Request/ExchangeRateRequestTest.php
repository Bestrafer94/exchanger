<?php

declare(strict_types=1);

namespace App\Tests\Gateway\Request;

use App\Gateway\Model\ExchangeRatesData;
use App\Gateway\Request\ExchangeRateRequest;
use App\Gateway\Response\ExchangeRateResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ExchangeRateRequestTest extends TestCase
{
    /**
     * @var ExchangeRateRequest
     */
    private $request;

    /**
     * @var ExchangeRatesData|MockObject
     */
    private $exchangeRatesDataMock;

    protected function setUp(): void
    {
        $this->exchangeRatesDataMock = $this->createMock(ExchangeRatesData::class);

        $this->request = new ExchangeRateRequest($this->exchangeRatesDataMock);
    }

    public function testGetRequestTarget()
    {
        $this->assertIsString($this->request->getRequestTarget());
    }

    public function testGetRequestName()
    {
        $this->assertIsString($this->request->getRequestName());
    }

    public function testGetResponseClass()
    {
        $this->assertEquals(ExchangeRateResponse::class, $this->request->getResponseClass());
    }

    public function testGetMethod()
    {
        $this->assertEquals('GET', $this->request->getMethod());
    }

    public function testGetParameters()
    {
        $this->exchangeRatesDataMock->method('getDate')->willReturn('latest');
        $this->exchangeRatesDataMock->method('getBaseCurrency')->willReturn('EUR');
        $this->exchangeRatesDataMock->method('getTargetCurrency')->willReturn('USD');

        $this->assertEquals(
            'latest?base=EUR&symbols=USD',
            $this->request->getParameters()
        );
    }
}
