<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\Transaction;
use App\Exception\TransactionsNotFoundException;
use App\Handler\Command\TransactionsListCommand;
use App\Repository\TransactionRepositoryInterface;
use App\Service\Transaction\TransactionSerializer;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

class TransactionsListCommandHandler
{
    const DEFAULT_NUMBER_OF_TRANSACTIONS_ON_PAGE = 10;

    /**
     * @var TransactionRepositoryInterface
     */
    private $transactionRepository;

    /**
     * @var PaginatorInterface
     */
    private $paginator;

    /**
     * @var TransactionSerializer
     */
    private $transactionSerializer;

    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        PaginatorInterface $paginator,
        TransactionSerializer $transactionSerializer
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->paginator = $paginator;
        $this->transactionSerializer = $transactionSerializer;
    }

    /**
     * @param TransactionsListCommand $command
     *
     * @return PaginationInterface
     */
    public function handle(TransactionsListCommand $command): PaginationInterface
    {
        $pagination = $this->paginator->paginate(
            $this->transactionRepository->getSearchQueryBuilder(),
            $command->getPageNumber(),
            self::DEFAULT_NUMBER_OF_TRANSACTIONS_ON_PAGE
        );

        if (0 === $pagination->count()) {
            throw new TransactionsNotFoundException();
        }

        return $this->convertItems($pagination);
    }

    /**
     * @param PaginationInterface $pagination
     *
     * @return PaginationInterface
     */
    private function convertItems(PaginationInterface $pagination): PaginationInterface
    {
        $newItems = [];

        /** @var Transaction $item */
        foreach ($pagination->getItems() as $item) {
            $newItems[] = $this->transactionSerializer->serialize($item);
        }

        $pagination->setItems($newItems);

        return $pagination;
    }
}
