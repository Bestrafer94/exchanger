<?php

declare(strict_types=1);

namespace App\Tests\Handler\Command;

use App\Form\Data\TransactionData;
use App\Handler\Command\TransactionCreateCommand;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TransactionCreateCommandTest extends TestCase
{
    /**
     * @var TransactionCreateCommand
     */
    private $transactionCreateCommand;

    /**
     * @var TransactionData|MockObject
     */
    private $transactionDataMock;

    private $clientIp = 'clientIp';

    protected function setUp(): void
    {
        $this->transactionDataMock = $this->createMock(TransactionData::class);

        $this->transactionCreateCommand = new TransactionCreateCommand(
            $this->transactionDataMock,
            $this->clientIp
        );
    }

    public function testGetters()
    {
        $targetCurrency = 'PLN';
        $baseCurrency = 'EUR';
        $amount = 100.2;
        $method = 2;
        $operation = 1;

        $this->transactionDataMock->method('getMethod')->willReturn($method);
        $this->transactionDataMock->method('getOperation')->willReturn($operation);
        $this->transactionDataMock->method('getBaseCurrency')->willReturn($baseCurrency);
        $this->transactionDataMock->method('getTargetCurrency')->willReturn($targetCurrency);
        $this->transactionDataMock->method('getAmount')->willReturn($amount);

        $this->assertEquals($this->clientIp, $this->transactionCreateCommand->getClientIp());
        $this->assertEquals($targetCurrency, $this->transactionCreateCommand->getTargetCurrency());
        $this->assertEquals($baseCurrency, $this->transactionCreateCommand->getBaseCurrency());
        $this->assertEquals($amount, $this->transactionCreateCommand->getAmount());
        $this->assertEquals($method, $this->transactionCreateCommand->getMethod());
        $this->assertEquals($operation, $this->transactionCreateCommand->getOperation());
    }
}
