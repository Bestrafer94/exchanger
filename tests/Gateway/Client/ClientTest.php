<?php

declare(strict_types=1);

namespace App\Tests\Gateway\Client;

use App\Gateway\Client\Client;
use App\Gateway\Request\RequestInterface;
use App\Gateway\Response\ExchangeRateResponse;
use App\Gateway\Response\ResponseInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var \GuzzleHttp\Client|MockObject
     */
    private $guzzleClientMock;

    /**
     * @var RequestInterface|MockObject
     */
    private $requestMock;

    protected function setUp(): void
    {
        $this->guzzleClientMock = $this->createMock(\GuzzleHttp\Client::class);
        $this->requestMock = $this->createMock(RequestInterface::class);

        $this->client = new Client($this->guzzleClientMock);
    }

    public function testExecute()
    {
        $this->requestMock->method('getResponseClass')->willReturn(ExchangeRateResponse::class);
        $psrResponseMock = $this->createMock(\Psr\Http\Message\ResponseInterface::class);
        $streamMock = $this->createMock(StreamInterface::class);
        $streamMock->method('getContents')->willReturn('content');
        $psrResponseMock->method('getBody')->willReturn($streamMock);
        $this->guzzleClientMock->method('request')->willReturn($psrResponseMock);

        $response = $this->client->execute($this->requestMock);

        $this->assertInstanceOf(ResponseInterface::class, $response);
    }
}
