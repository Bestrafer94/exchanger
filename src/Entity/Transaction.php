<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="payment_method", type="integer")
     *
     * @var int
     */
    private $paymentMethod;

    /**
     * @ORM\Column(name="transaction_operation", type="integer")
     *
     * @var int
     */
    private $transactionOperation;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(name="base_amount", type="integer")
     *
     * @var int
     */
    private $baseAmount;

    /**
     * @ORM\Column(name="target_amount", type="integer")
     *
     * @var int
     */
    private $targetAmount;

    /**
     * @ORM\Column(name="base_currency", type="string", length=3)
     *
     * @var string
     */
    private $baseCurrency;

    /**
     * @ORM\Column(name="target_currency", type="string", length=3)
     *
     * @var string
     */
    private $targetCurrency;

    /**
     * @ORM\Column(name="exchange_rate", type="integer")
     *
     * @var int
     */
    private $exchangeRate;

    /**
     * @ORM\Column(name="client_ip", type="string", length=45)
     *
     * @var string
     */
    private $clientIp;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Transaction
     */
    public function setId(int $id): Transaction
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getPaymentMethod(): int
    {
        return $this->paymentMethod;
    }

    /**
     * @param int $paymentMethod
     *
     * @return Transaction
     */
    public function setPaymentMethod(int $paymentMethod): Transaction
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * @return int
     */
    public function getTransactionOperation(): int
    {
        return $this->transactionOperation;
    }

    /**
     * @param int $transactionOperation
     *
     * @return Transaction
     */
    public function setTransactionOperation(int $transactionOperation): Transaction
    {
        $this->transactionOperation = $transactionOperation;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     *
     * @return Transaction
     */
    public function setUpdatedAt(DateTime $updatedAt): Transaction
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return int
     */
    public function getBaseAmount(): int
    {
        return $this->baseAmount;
    }

    /**
     * @param int $baseAmount
     *
     * @return Transaction
     */
    public function setBaseAmount(int $baseAmount): Transaction
    {
        $this->baseAmount = $baseAmount;

        return $this;
    }

    /**
     * @return int
     */
    public function getTargetAmount(): int
    {
        return $this->targetAmount;
    }

    /**
     * @param int $targetAmount
     *
     * @return Transaction
     */
    public function setTargetAmount(int $targetAmount): Transaction
    {
        $this->targetAmount = $targetAmount;

        return $this;
    }

    /**
     * @return string
     */
    public function getBaseCurrency(): string
    {
        return $this->baseCurrency;
    }

    /**
     * @param string $baseCurrency
     *
     * @return Transaction
     */
    public function setBaseCurrency(string $baseCurrency): Transaction
    {
        $this->baseCurrency = $baseCurrency;

        return $this;
    }

    /**
     * @return string
     */
    public function getTargetCurrency(): string
    {
        return $this->targetCurrency;
    }

    /**
     * @param string $targetCurrency
     *
     * @return Transaction
     */
    public function setTargetCurrency(string $targetCurrency): Transaction
    {
        $this->targetCurrency = $targetCurrency;

        return $this;
    }

    /**
     * @return int
     */
    public function getExchangeRate(): int
    {
        return $this->exchangeRate;
    }

    /**
     * @param int $exchangeRate
     *
     * @return Transaction
     */
    public function setExchangeRate(int $exchangeRate): Transaction
    {
        $this->exchangeRate = $exchangeRate;

        return $this;
    }

    /**
     * @return string
     */
    public function getClientIp(): string
    {
        return $this->clientIp;
    }

    /**
     * @param string $clientIp
     *
     * @return Transaction
     */
    public function setClientIp(string $clientIp): Transaction
    {
        $this->clientIp = $clientIp;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     *
     * @return Transaction
     */
    public function setCreatedAt(DateTime $createdAt): Transaction
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
