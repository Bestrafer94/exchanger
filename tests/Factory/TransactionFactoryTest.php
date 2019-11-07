<?php

declare(strict_types=1);

namespace App\Tests\Factory;

use App\Entity\Transaction;
use App\Factory\TransactionFactory;
use App\Provider\ExchangeRate\ExchangeRateFromChainProvider;
use App\Service\FinancialConverter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TransactionFactoryTest extends TestCase
{
    /**
     * @var TransactionFactory
     */
    private $transactionFactory;

    /**
     * @var ExchangeRateFromChainProvider|MockObject
     */
    private $exchangeRateFromChainProvider;

    /**
     * @var FinancialConverter|MockObject
     */
    private $financialConverter;

    protected function setUp(): void
    {
        $this->exchangeRateFromChainProvider = $this->createMock(ExchangeRateFromChainProvider::class);
        $this->financialConverter = $this->createMock(FinancialConverter::class);

        $this->transactionFactory = new TransactionFactory(
            $this->exchangeRateFromChainProvider,
            $this->financialConverter
        );
    }

    public function testCreate()
    {
        $targetAmount = 9040;
        $exchangeRate = 2.13;
        $exchangeRateConverted = 21300;
        $baseAmount = 40.32;
        $baseAmountConverted = 4032;
        $baseCurrency = 'EUR';
        $targetCurrency = 'PLN';
        $clientIp = 'clientIp';
        $transactionOperation = 1;
        $paymentMethod = 3;

        $this->exchangeRateFromChainProvider->method('provide')->willReturn($exchangeRate);
        $this->financialConverter
            ->method('amountToDatabaseConverter')
            ->with($baseAmount)
            ->willReturn($baseAmountConverted);
        $this->financialConverter
            ->method('exchangeRateToDatabaseConverter')
            ->with($exchangeRate)
            ->willReturn($exchangeRateConverted);
        $this->financialConverter
            ->method('calculateTargetAmount')
            ->with($baseAmount, $exchangeRate)
            ->willReturn($targetAmount);

        $transaction = $this->transactionFactory->create(
            $baseAmount,
            $baseCurrency,
            $targetCurrency,
            $clientIp,
            $transactionOperation,
            $paymentMethod
        );

        $this->assertInstanceOf(Transaction::class, $transaction);
        $this->assertNull($transaction->getUpdatedAt());
        $this->assertIsObject($transaction->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $transaction->getCreatedAt());
        $this->assertEquals($clientIp, $transaction->getClientIp());
        $this->assertEquals($targetAmount, $transaction->getTargetAmount());
        $this->assertEquals($targetCurrency, $transaction->getTargetCurrency());
        $this->assertEquals($exchangeRateConverted, $transaction->getExchangeRate());
        $this->assertEquals($paymentMethod, $transaction->getPaymentMethod());
        $this->assertEquals($transactionOperation, $transaction->getTransactionOperation());
        $this->assertEquals($baseCurrency, $transaction->getBaseCurrency());
        $this->assertEquals($baseAmountConverted, $transaction->getBaseAmount());
    }
}
