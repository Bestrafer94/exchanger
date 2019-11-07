<?php

declare(strict_types=1);

namespace App\Handler;

use App\Exception\TransactionNotFoundException;
use App\Handler\Command\TransactionDetailsCommand;
use App\Repository\TransactionRepositoryInterface;
use App\Service\Transaction\TransactionSerializer;

class TransactionDetailsCommandHandler
{
    /**
     * @var TransactionRepositoryInterface
     */
    private $transactionRepository;

    /**
     * @var TransactionSerializer
     */
    private $transactionSerializer;

    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        TransactionSerializer $transactionSerializer
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->transactionSerializer = $transactionSerializer;
    }

    /**
     * @param TransactionDetailsCommand $command
     *
     * @return array
     */
    public function handle(TransactionDetailsCommand $command): array
    {
        $transaction = $this->transactionRepository->fetch($command->getId());

        if (!$transaction) {
            throw new TransactionNotFoundException();
        }

        return $this->transactionSerializer->serialize($transaction);
    }
}
