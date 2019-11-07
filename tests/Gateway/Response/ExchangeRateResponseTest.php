<?php

declare(strict_types=1);

namespace App\Tests\Gateway\Response;

use App\Gateway\Response\ExchangeRateResponse;
use PHPUnit\Framework\TestCase;

class ExchangeRateResponseTest extends TestCase
{
    public function testIsSuccessful()
    {
        $response = new ExchangeRateResponse('{"rates":{"PLN":4.32}}');

        $this->assertTrue($response->isSuccessful());
    }

    public function testIsNotSuccessfulErrorMessage()
    {
        $response = new ExchangeRateResponse('{"error":"invalid data"}');

        $this->assertFalse($response->isSuccessful());
    }

    public function testIsNotSuccessfulEmptyMessage()
    {
        $response = new ExchangeRateResponse('{}');

        $this->assertFalse($response->isSuccessful());
    }

    public function testGetErrorMessageForSuccessFulResponse()
    {
        $response = new ExchangeRateResponse('{"rates":{"PLN":4.32}}');

        $this->assertNull($response->getErrorMessage());
    }

    public function testGetErrorMessageForEmptyMessage()
    {
        $response = new ExchangeRateResponse('{}');

        $this->assertEquals('Connection problem', $response->getErrorMessage());
    }

    public function testGetErrorMessageForUnsuccessfulResponse()
    {
        $response = new ExchangeRateResponse('{"error":"Invalid request"}');

        $this->assertEquals('Invalid request', $response->getErrorMessage());
    }

    public function testGetRate()
    {
        $response = new ExchangeRateResponse('{"rates":{"PLN":4.32}}');

        $this->assertEquals(4.32, $response->getRate());
    }

    public function testGetRawData()
    {
        $response = new ExchangeRateResponse('{"rates":{"PLN":4.32}}');

        $this->assertEquals('{"rates":{"PLN":4.32}}', $response->getRawData());
    }
}
