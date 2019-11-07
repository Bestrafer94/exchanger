<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Transaction;
use App\Service\FinancialConverter;
use App\Service\Transaction\TransactionSerializer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TransactionSerializerTest extends TestCase
{
    /**
     * @var TransactionSerializer
     */
    private $serializer;

    /**
     * @var FinancialConverter|MockObject
     */
    private $financialConverterMock;

    protected function setUp(): void
    {
        $this->financialConverterMock = $this->createMock(FinancialConverter::class);

        $this->serializer = new TransactionSerializer($this->financialConverterMock);
    }

    public function testSerialize()
    {
        $updatedAt = $createdAt = new \DateTime();
        $id = 7;
        $clientIp = 'clientIp';
        $targetAmount = 150;
        $targetCurrency = 'PLN';
        $exchangeRate = 421;
        $paymentMethod = 3;
        $transactionOperation = 1;
        $baseCurrency = 'EUR';
        $baseAmount = 40;

        $transaction = (new Transaction())
            ->setId($id)
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

        $baseAmountConverted = 23.0;
        $targetAmountConverted = 19.0;
        $exchangeRateConverted = 0.93;

        $this->financialConverterMock
            ->expects($this->at(1))
            ->method('amountFromDatabaseConverter')
            ->willReturn($baseAmountConverted);
        $this->financialConverterMock
            ->expects($this->at(2))
            ->method('amountFromDatabaseConverter')
            ->willReturn($targetAmountConverted);

        $this->financialConverterMock->method('exchangeRateFromDatabaseConverter')
            ->willReturn($exchangeRateConverted);

        $result = $this->serializer->serialize($transaction);

        $this->assertEquals([
            'id' => $id,
            'updated_at' => $updatedAt->format('Y-m-d H:i:s'),
            'created_at' => $transaction->getCreatedAt()->format('Y-m-d H:i:s'),
            'base_amount' => $baseAmountConverted,
            'target_amount' => $targetAmountConverted,
            'exchange_rate' => $exchangeRateConverted,
            'base_currency' => $transaction->getBaseCurrency(),
            'target_currency' => $transaction->getTargetCurrency(),
            'client_ip' => $transaction->getClientIp(),
            'operation_type' => 'withdrawal',
            'payment_method' => 'voucher',
        ], $result);
    }
}
