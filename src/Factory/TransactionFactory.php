<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Transaction;
use App\Provider\ExchangeRate\ExchangeRateFromChainProvider;
use App\Service\FinancialConverter;

class TransactionFactory implements TransactionFactoryInterface
{
    /**
     * @var ExchangeRateFromChainProvider
     */
    private $exchangeFromChainProvider;

    /**
     * @var FinancialConverter
     */
    private $financialConverter;

    public function __construct(
        ExchangeRateFromChainProvider $exchangeFromChainProvider,
        FinancialConverter $financialConverter
    ) {
        $this->exchangeFromChainProvider = $exchangeFromChainProvider;
        $this->financialConverter = $financialConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function create(
        float $baseAmount,
        string $baseCurrency,
        string $targetCurrency,
        string $clientIp,
        int $operationType,
        int $paymentMethod
    ): Transaction {
        $exchangeRate = $this->exchangeFromChainProvider->provide($baseCurrency, $targetCurrency);

        return (new Transaction())
            ->setCreatedAt(new \DateTime())
            ->setBaseAmount($this->financialConverter->amountToDatabaseConverter($baseAmount))
            ->setTargetAmount($this->financialConverter->calculateTargetAmount($baseAmount, $exchangeRate))
            ->setExchangeRate($this->financialConverter->exchangeRateToDatabaseConverter($exchangeRate))
            ->setBaseCurrency($baseCurrency)
            ->setTargetCurrency($targetCurrency)
            ->setClientIp($clientIp)
            ->setTransactionOperation($operationType)
            ->setPaymentMethod($paymentMethod);
    }
}
