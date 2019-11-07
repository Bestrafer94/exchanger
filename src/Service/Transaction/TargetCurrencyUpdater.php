<?php

declare(strict_types=1);

namespace App\Service\Transaction;

use App\Entity\Transaction;
use App\Provider\ExchangeRate\ExchangeRateFromChainProvider;
use App\Service\FinancialConverter;
use Doctrine\ORM\EntityManagerInterface;

class TargetCurrencyUpdater
{
    /**
     * @var ExchangeRateFromChainProvider
     */
    private $exchangeFromChainProvider;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var FinancialConverter
     */
    private $financialConverter;

    public function __construct(
        ExchangeRateFromChainProvider $exchangeFromChainProvider,
        EntityManagerInterface $entityManager,
        FinancialConverter $financialConverter
    ) {
        $this->exchangeFromChainProvider = $exchangeFromChainProvider;
        $this->entityManager = $entityManager;
        $this->financialConverter = $financialConverter;
    }

    /**
     * @param Transaction $transaction
     * @param string $currency
     *
     * @return Transaction
     */
    public function update(Transaction $transaction, string $currency): Transaction
    {
        $exchangeRate = $this->exchangeFromChainProvider->provide(
            $transaction->getBaseCurrency(),
            $currency
        );

        $baseAmount = $this->financialConverter->amountFromDatabaseConverter($transaction->getBaseAmount());

        $transaction->setTargetCurrency($currency);
        $transaction->setExchangeRate($this->financialConverter->exchangeRateToDatabaseConverter($exchangeRate));
        $transaction->setTargetAmount($this->financialConverter->calculateTargetAmount($baseAmount, $exchangeRate));
        $transaction->setUpdatedAt(new \DateTime());

        $this->entityManager->flush();

        return $transaction;
    }
}
