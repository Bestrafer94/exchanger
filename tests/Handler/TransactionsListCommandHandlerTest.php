<?php

declare(strict_types=1);

namespace App\Tests\Handler;

use App\Entity\Transaction;
use App\Exception\TransactionsNotFoundException;
use App\Handler\Command\TransactionsListCommand;
use App\Handler\TransactionsListCommandHandler;
use App\Repository\TransactionRepositoryInterface;
use App\Service\Transaction\TransactionSerializer;
use Doctrine\ORM\QueryBuilder;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TransactionsListCommandHandlerTest extends TestCase
{
    /**
     * @var TransactionsListCommandHandler
     */
    private $transactionsListCommandHandler;

    /**
     * @var TransactionRepositoryInterface|MockObject
     */
    private $transactionRepositoryMock;

    /**
     * @var TransactionSerializer|MockObject
     */
    private $transactionSerializerMock;

    /**
     * @var PaginatorInterface|MockObject
     */
    private $paginatorMock;

    /**
     * @var QueryBuilder|MockObject
     */
    private $queryBuilderMock;

    /**
     * @var PaginationInterface|MockObject
     */
    private $paginationMock;

    /**
     * @var TransactionsListCommand|MockObject
     */
    private $transactionsListCommandMock;

    protected function setUp(): void
    {
        $this->transactionRepositoryMock = $this->createMock(TransactionRepositoryInterface::class);
        $this->transactionSerializerMock = $this->createMock(TransactionSerializer::class);
        $this->paginatorMock = $this->createMock(PaginatorInterface::class);
        $this->transactionsListCommandMock = $this->createMock(TransactionsListCommand::class);
        $this->queryBuilderMock = $this->createMock(QueryBuilder::class);
        $this->paginationMock = $this->createMock(PaginationInterface::class);

        $pageNumber = 3;
        $this->transactionsListCommandMock->method('getPageNumber')->willReturn($pageNumber);
        $this->transactionRepositoryMock->method('getSearchQueryBuilder')->willReturn($this->queryBuilderMock);
        $this->paginatorMock
            ->method('paginate')
            ->with($this->queryBuilderMock, $pageNumber, TransactionsListCommandHandler::DEFAULT_NUMBER_OF_TRANSACTIONS_ON_PAGE)
            ->willReturn($this->paginationMock);

        $this->transactionsListCommandHandler = new TransactionsListCommandHandler(
            $this->transactionRepositoryMock,
            $this->paginatorMock,
            $this->transactionSerializerMock
        );
    }

    public function testHandleWithTransactionsNotFoundException()
    {
        $this->paginationMock->method('count')->willReturn(0);

        $this->expectException(TransactionsNotFoundException::class);

        $this->transactionsListCommandHandler->handle($this->transactionsListCommandMock);
    }

    public function testHandle()
    {
        $transactionsCount = 3;
        $serializedTransaction = ['id' => 5];
        $transactionMock = $this->createMock(Transaction::class);
        $this->paginationMock->method('count')->willReturn($transactionsCount);
        $this->paginationMock->method('getItems')->willReturn(
            [$transactionMock, $transactionMock, $transactionMock]);
        $this->transactionSerializerMock
            ->expects($this->exactly($transactionsCount))
            ->method('serialize')
            ->willReturn($serializedTransaction);

        $result = $this->transactionsListCommandHandler->handle($this->transactionsListCommandMock);

        $this->assertInstanceOf(PaginationInterface::class, $result);
    }
}
