<?php

declare(strict_types=1);

namespace App\Tests\Handler;

use App\Entity\Transaction;
use App\Exception\TransactionNotFoundException;
use App\Handler\Command\TransactionDetailsCommand;
use App\Handler\TransactionDetailsCommandHandler;
use App\Repository\TransactionRepositoryInterface;
use App\Service\Transaction\TransactionSerializer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TransactionDetailsCommandHandlerTest extends TestCase
{
    /**
     * @var TransactionDetailsCommandHandler
     */
    private $transactionCreateCommandHandler;

    /**
     * @var TransactionRepositoryInterface|MockObject
     */
    private $transactionRepositoryMock;

    /**
     * @var TransactionSerializer|MockObject
     */
    private $transactionSerializerMock;

    /**
     * @var TransactionDetailsCommand|MockObject
     */
    private $transactionDetailsCommandMock;

    protected function setUp(): void
    {
        $this->transactionRepositoryMock = $this->createMock(TransactionRepositoryInterface::class);
        $this->transactionSerializerMock = $this->createMock(TransactionSerializer::class);
        $this->transactionDetailsCommandMock = $this->createMock(TransactionDetailsCommand::class);

        $this->transactionCreateCommandHandler = new TransactionDetailsCommandHandler(
            $this->transactionRepositoryMock,
            $this->transactionSerializerMock
        );
    }

    public function testHandleWithTransactionNotFoundException()
    {
        $id = 5;
        $this->transactionDetailsCommandMock->method('getId')->willReturn($id);
        $this->transactionRepositoryMock->method('fetch')->with($id)->willReturn(null);

        $this->expectException(TransactionNotFoundException::class);

        $this->transactionCreateCommandHandler->handle($this->transactionDetailsCommandMock);
    }

    public function testHandle()
    {
        $transaction = new Transaction();
        $serializedTransaction = ['id' => 5];
        $id = 5;

        $this->transactionDetailsCommandMock->method('getId')->willReturn($id);
        $this->transactionRepositoryMock->method('fetch')->with($id)->willReturn($transaction);
        $this->transactionSerializerMock->method('serialize')->willReturn($serializedTransaction);

        $result = $this->transactionCreateCommandHandler->handle($this->transactionDetailsCommandMock);

        $this->assertEquals($serializedTransaction, $result);
    }
}
