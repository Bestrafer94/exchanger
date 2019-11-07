<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Transaction;
use App\Provider\ExchangeRate\ExchangeRateFromChainProvider;
use App\Service\FinancialConverter;
use App\Service\Transaction\TargetCurrencyUpdater;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TargetCurrencyUpdaterTest extends TestCase
{
    /**
     * @var TargetCurrencyUpdater
     */
    private $updater;

    /**
     * @var ExchangeRateFromChainProvider|MockObject
     */
    private $exchangeFromChainProviderMock;

    /**
     * @var EntityManagerInterface|MockObject
     */
    private $entityManagerMock;

    /**
     * @var FinancialConverter|MockObject
     */
    private $financialConverterMock;

    protected function setUp(): void
    {
        $this->exchangeFromChainProviderMock = $this->createMock(ExchangeRateFromChainProvider::class);
        $this->entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $this->financialConverterMock = $this->createMock(FinancialConverter::class);

        $this->updater = new TargetCurrencyUpdater(
            $this->exchangeFromChainProviderMock,
            $this->entityManagerMock,
            $this->financialConverterMock
        );
    }

    public function testUpdate()
    {
        $baseAmount = 100;
        $baseAmountConverted = 1.0;
        $exchangeRate = 2.22;
        $exchangeRateConverted = 22200;
        $targetAmount = 222;

        $transaction = (new Transaction())
            ->setBaseAmount($baseAmount)
            ->setBaseCurrency('NOK');

        $this->exchangeFromChainProviderMock->method('provide')->willReturn($exchangeRate);
        $this->financialConverterMock
            ->method('amountFromDatabaseConverter')
            ->with($baseAmount)
            ->willReturn($baseAmountConverted);
        $this->financialConverterMock
            ->method('exchangeRateToDatabaseConverter')
            ->with($exchangeRate)
            ->willReturn($exchangeRateConverted);
        $this->financialConverterMock
            ->method('calculateTargetAmount')
            ->with($baseAmountConverted, $exchangeRate)
            ->willReturn($targetAmount);

        $this->entityManagerMock
            ->expects($this->once())
            ->method('flush');

        $result = $this->updater->update($transaction, 'EUR');

        $this->assertInstanceOf(Transaction::class, $result);
        $this->assertIsObject($result->getUpdatedAt());
        $this->assertEquals('EUR', $result->getTargetCurrency());
        $this->assertEquals($exchangeRateConverted, $result->getExchangeRate());
        $this->assertEquals($targetAmount, $result->getTargetAmount());
    }
}
