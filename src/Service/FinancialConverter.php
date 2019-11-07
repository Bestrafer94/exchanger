<?php

declare(strict_types=1);

namespace App\Service;

class FinancialConverter
{
    /**
     * @param float $baseAmount
     * @param float $exchangeRate
     *
     * @return int
     */
    public function calculateTargetAmount(float $baseAmount, float $exchangeRate): int
    {
        $baseAmount = round($baseAmount, 2);
        $targetAmount = round($baseAmount * $exchangeRate, 2);

        return $this->amountToDatabaseConverter($targetAmount);
    }

    /**
     * @param float $amount
     *
     * @return int
     */
    public function amountToDatabaseConverter(float $amount): int
    {
        return (int) (round($amount, 2) * 100);
    }

    /**
     * @param int $amount
     *
     * @return float
     */
    public function amountFromDatabaseConverter(int $amount): float
    {
        return $amount / 100;
    }

    /**
     * @param float $exchangeRate
     *
     * @return int
     */
    public function exchangeRateToDatabaseConverter(float $exchangeRate): int
    {
        return (int) ($exchangeRate * 100000);
    }

    /**
     * @param int $amount
     *
     * @return float
     */
    public function exchangeRateFromDatabaseConverter(int $amount): float
    {
        return $amount / 100000;
    }
}
