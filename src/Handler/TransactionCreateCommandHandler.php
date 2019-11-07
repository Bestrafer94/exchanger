<?php

declare(strict_types=1);

namespace App\Handler;

use App\Exception\SameCurrenciesException;
use App\Factory\TransactionFactoryInterface;
use App\Handler\Command\TransactionCreateCommand;
use App\Service\Transaction\TransactionSerializer;
use Doctrine\ORM\EntityManagerInterface;

class TransactionCreateCommandHandler
{
    /**
     * @var TransactionFactoryInterface
     */
    private $transactionFactory;

    /**
     * @var TransactionSerializer
     */
    private $transactionSerializer;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        TransactionFactoryInterface $transactionFactory,
        TransactionSerializer $transactionSerializer,
        EntityManagerInterface $entityManager
    ) {
        $this->transactionFactory = $transactionFactory;
        $this->transactionSerializer = $transactionSerializer;
        $this->entityManager = $entityManager;
    }

    /**
     * @param TransactionCreateCommand $command
     *
     * @return array
     */
    public function handle(TransactionCreateCommand $command): array
    {
        $baseCurrency = $command->getBaseCurrency();
        $targetCurrency = $command->getTargetCurrency();

        if ($baseCurrency === $targetCurrency) {
            throw new SameCurrenciesException();
        }

        $transaction = $this->transactionFactory->create(
            $command->getAmount(),
            $baseCurrency,
            $targetCurrency,
            $command->getClientIp(),
            $command->getOperation(),
            $command->getMethod()
        );

        $this->entityManager->persist($transaction);
        $this->entityManager->flush();

        return $this->transactionSerializer->serialize($transaction);
    }
}
