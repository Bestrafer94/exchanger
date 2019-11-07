<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Transaction;

interface TransactionFactoryInterface
{
    /**
     * @param float $baseAmount
     * @param string $baseCurrency
     * @param string $targetCurrency
     * @param string $clientIp
     * @param int $operationType
     * @param int $paymentMethod
     *
     * @return Transaction
     */
    public function create(
        float $baseAmount,
        string $baseCurrency,
        string $targetCurrency,
        string $clientIp,
        int $operationType,
        int $paymentMethod
    ): Transaction;
}
