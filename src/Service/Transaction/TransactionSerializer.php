<?php

declare(strict_types=1);

namespace App\Service\Transaction;

use App\Dictionary\PaymentMethod;
use App\Dictionary\TransactionOperation;
use App\Entity\Transaction;
use App\Service\FinancialConverter;

class TransactionSerializer
{
    /**
     * @var FinancialConverter
     */
    private $financialConverter;

    public function __construct(FinancialConverter $financialConverter)
    {
        $this->financialConverter = $financialConverter;
    }

    /**
     * @param Transaction $transaction
     *
     * @return array
     */
    public function serialize(Transaction $transaction): array
    {
        $updatedAt = $transaction->getUpdatedAt()
            ? $transaction->getUpdatedAt()->format('Y-m-d H:i:s')
            : null;

        $exchangeRate = $this->financialConverter->exchangeRateFromDatabaseConverter($transaction->getExchangeRate());

        return [
            'id' => $transaction->getId(),
            'updated_at' => $updatedAt,
            'created_at' => $transaction->getCreatedAt()->format('Y-m-d H:i:s'),
            'base_amount' => $this->financialConverter->amountFromDatabaseConverter($transaction->getBaseAmount()),
            'target_amount' => $this->financialConverter->amountFromDatabaseConverter($transaction->getTargetAmount()),
            'exchange_rate' => $exchangeRate,
            'base_currency' => $transaction->getBaseCurrency(),
            'target_currency' => $transaction->getTargetCurrency(),
            'client_ip' => $transaction->getClientIp(),
            'operation_type' => TransactionOperation::getNameByKey($transaction->getTransactionOperation()),
            'payment_method' => PaymentMethod::getNameByKey($transaction->getPaymentMethod()),
        ];
    }
}
