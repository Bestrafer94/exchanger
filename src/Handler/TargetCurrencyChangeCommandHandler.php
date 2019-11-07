<?php

declare(strict_types=1);

namespace App\Handler;

use App\Exception\SameCurrenciesException;
use App\Handler\Command\TargetCurrencyChangeCommand;
use App\Repository\TransactionRepositoryInterface;
use App\Service\Transaction\TargetCurrencyUpdater;
use App\Service\Transaction\TransactionSerializer;

class TargetCurrencyChangeCommandHandler
{
    /**
     * @var TransactionRepositoryInterface
     */
    private $transactionRepository;

    /**
     * @var TransactionSerializer
     */
    private $transactionSerializer;

    /**
     * @var TargetCurrencyUpdater
     */
    private $targetCurrencyUpdater;

    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        TransactionSerializer $transactionSerializer,
        TargetCurrencyUpdater $targetCurrencyUpdater
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->transactionSerializer = $transactionSerializer;
        $this->targetCurrencyUpdater = $targetCurrencyUpdater;
    }

    /**
     * @param TargetCurrencyChangeCommand $command
     *
     * @return array
     */
    public function handle(TargetCurrencyChangeCommand $command): array
    {
        $newCurrency = $command->getCurrency();
        $transaction = $this->transactionRepository->fetch($command->getId());

        if ($newCurrency === $transaction->getBaseCurrency() || $newCurrency === $transaction->getTargetCurrency()) {
            throw new SameCurrenciesException();
        }

        $transaction = $this->targetCurrencyUpdater->update($transaction, $newCurrency);

        return $this->transactionSerializer->serialize($transaction);
    }
}
