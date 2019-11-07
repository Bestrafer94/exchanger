<?php

declare(strict_types=1);

namespace App\Tests\Handler;

use App\Entity\Transaction;
use App\Exception\SameCurrenciesException;
use App\Factory\TransactionFactoryInterface;
use App\Handler\Command\TransactionCreateCommand;
use App\Handler\TransactionCreateCommandHandler;
use App\Service\Transaction\TransactionSerializer;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TransactionCreateCommandHandlerTest extends TestCase
{
    /**
     * @var TransactionCreateCommandHandler
     */
    private $transactionCreateCommandHandler;

    /**
     * @var TransactionFactoryInterface|MockObject
     */
    private $transactionFactoryMock;

    /**
     * @var TransactionSerializer|MockObject
     */
    private $transactionSerializerMock;

    /**
     * @var EntityManagerInterface|MockObject
     */
    private $entityManagerMock;

    /**
     * @var TransactionCreateCommand|MockObject
     */
    private $transactionCreateCommandMock;

    protected function setUp(): void
    {
        $this->transactionFactoryMock = $this->createMock(TransactionFactoryInterface::class);
        $this->transactionSerializerMock = $this->createMock(TransactionSerializer::class);
        $this->entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $this->transactionCreateCommandMock = $this->createMock(TransactionCreateCommand::class);

        $this->transactionCreateCommandHandler = new TransactionCreateCommandHandler(
            $this->transactionFactoryMock,
            $this->transactionSerializerMock,
            $this->entityManagerMock
        );
    }

    public function testHandleWithSameCurrenciesException()
    {
        $this->transactionCreateCommandMock->method('getBaseCurrency')->willReturn('EUR');
        $this->transactionCreateCommandMock->method('getTargetCurrency')->willReturn('EUR');

        $this->expectException(SameCurrenciesException::class);

        $this->transactionCreateCommandHandler->handle($this->transactionCreateCommandMock);
    }

    public function testHandle()
    {
        $transaction = new Transaction();
        $serializedTransaction = ['id' => 5];

        $this->transactionCreateCommandMock->method('getBaseCurrency')->willReturn('EUR');
        $this->transactionCreateCommandMock->method('getTargetCurrency')->willReturn('PLN');
        $this->transactionFactoryMock->method('create')->willReturn($transaction);
        $this->transactionSerializerMock->method('serialize')->willReturn($serializedTransaction);

        $result = $this->transactionCreateCommandHandler->handle($this->transactionCreateCommandMock);

        $this->assertEquals($serializedTransaction, $result);
    }
}
