<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Transaction;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
    public function testCreate()
    {
        $updatedAt = $createdAt = new \DateTime();
        $clientIp = 'clientIp';
        $targetAmount = 150;
        $targetCurrency = 'PLN';
        $exchangeRate = 421;
        $paymentMethod = 3;
        $transactionOperation = 1;
        $baseCurrency = 'EUR';
        $baseAmount = 40;

        $transaction = (new Transaction())
            ->setUpdatedAt($updatedAt)
            ->setClientIp($clientIp)
            ->setTargetAmount($targetAmount)
            ->setTargetCurrency($targetCurrency)
            ->setExchangeRate($exchangeRate)
            ->setCreatedAt($createdAt)
            ->setPaymentMethod($paymentMethod)
            ->setTransactionOperation($transactionOperation)
            ->setBaseCurrency($baseCurrency)
            ->setBaseAmount($baseAmount);

        $this->assertEquals($updatedAt, $transaction->getUpdatedAt());
        $this->assertEquals($createdAt, $transaction->getCreatedAt());
        $this->assertEquals($clientIp, $transaction->getClientIp());
        $this->assertEquals($targetAmount, $transaction->getTargetAmount());
        $this->assertEquals($targetCurrency, $transaction->getTargetCurrency());
        $this->assertEquals($exchangeRate, $transaction->getExchangeRate());
        $this->assertEquals($paymentMethod, $transaction->getPaymentMethod());
        $this->assertEquals($transactionOperation, $transaction->getTransactionOperation());
        $this->assertEquals($baseCurrency, $transaction->getBaseCurrency());
        $this->assertEquals($baseAmount, $transaction->getBaseAmount());
    }
}
