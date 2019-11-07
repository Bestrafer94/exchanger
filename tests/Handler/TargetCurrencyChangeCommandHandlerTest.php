<?php

declare(strict_types=1);

namespace App\Tests\Handler;

use App\Entity\Transaction;
use App\Exception\SameCurrenciesException;
use App\Factory\TransactionFactoryInterface;
use App\Handler\Command\TargetCurrencyChangeCommand;
use App\Handler\Command\TransactionCreateCommand;
use App\Handler\TargetCurrencyChangeCommandHandler;
use App\Handler\TransactionCreateCommandHandler;
use App\Repository\TransactionRepositoryInterface;
use App\Service\Transaction\TargetCurrencyUpdater;
use App\Service\Transaction\TransactionSerializer;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TargetCurrencyChangeCommandHandlerTest extends TestCase
{
    /**
     * @var TargetCurrencyChangeCommandHandler
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
     * @var TargetCurrencyUpdater|MockObject
     */
    private $targetCurrencyUpdaterMock;

    /**
     * @var TargetCurrencyChangeCommand|MockObject
     */
    private $targetCurrencyChangeCommandMock;

    /**
     * @var Transaction|MockObject
     */
    private $transactionMock;

    protected function setUp(): void
    {
        $this->transactionRepositoryMock = $this->createMock(TransactionRepositoryInterface::class);
        $this->transactionSerializerMock = $this->createMock(TransactionSerializer::class);
        $this->targetCurrencyUpdaterMock = $this->createMock(TargetCurrencyUpdater::class);
        $this->targetCurrencyChangeCommandMock = $this->createMock(TargetCurrencyChangeCommand::class);
        $this->transactionMock = $this->createMock(Transaction::class);

        $id = 7;
        $this->targetCurrencyChangeCommandMock->method('getCurrency')->willReturn('EUR');
        $this->targetCurrencyChangeCommandMock->method('getId')->willReturn($id);
        $this->transactionRepositoryMock->method('fetch')->with($id)->willReturn($this->transactionMock);

        $this->transactionCreateCommandHandler = new TargetCurrencyChangeCommandHandler(
            $this->transactionRepositoryMock,
            $this->transactionSerializerMock,
            $this->targetCurrencyUpdaterMock
        );
    }

    public function testHandleWithSameCurrenciesException()
    {
        $this->transactionMock->method('getBaseCurrency')->willReturn('EUR');
        $this->transactionMock->method('getTargetCurrency')->willReturn('PLN');

        $this->expectException(SameCurrenciesException::class);

        $this->transactionCreateCommandHandler->handle($this->targetCurrencyChangeCommandMock);
    }

    public function testHandle()
    {
        $serializedTransaction = ['id' => 5];

        $this->transactionMock->method('getBaseCurrency')->willReturn('PHP');
        $this->transactionMock->method('getTargetCurrency')->willReturn('PLN');
        $this->targetCurrencyUpdaterMock->method('update')->willReturn($this->transactionMock);
        $this->transactionSerializerMock->method('serialize')->willReturn($serializedTransaction);

        $result = $this->transactionCreateCommandHandler->handle($this->targetCurrencyChangeCommandMock);

        $this->assertEquals($serializedTransaction, $result);
    }
}
