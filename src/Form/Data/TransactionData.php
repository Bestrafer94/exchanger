<?php

declare(strict_types=1);

namespace App\Form\Data;

use App\Validator\Currency;
use App\Validator\Method;
use App\Validator\OperationType;
use Symfony\Component\Validator\Constraints as Assert;

class TransactionData
{
    /**
     * @var int|null
     *
     * @Method()
     */
    protected $method;

    /**
     * @var int|null
     *
     * @OperationType()
     */
    protected $operation;

    /**
     * @var string|null
     *
     * @Currency()
     */
    protected $baseCurrency;

    /**
     * @var string|null
     *
     * @Currency()
     */
    protected $targetCurrency;

    /**
     * @var float|null
     *
     * @Assert\GreaterThan(0)
     */
    protected $amount;

    /**
     * @return int|null
     */
    public function getMethod(): ?int
    {
        return (int) $this->method;
    }

    /**
     * @param string|null $method
     *
     * @return TransactionData
     */
    public function setMethod(?string $method): TransactionData
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOperation(): ?int
    {
        return (int) $this->operation;
    }

    /**
     * @param string|null $operation
     *
     * @return TransactionData
     */
    public function setOperation(?string $operation): TransactionData
    {
        $this->operation = $operation;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBaseCurrency(): ?string
    {
        return $this->baseCurrency;
    }

    /**
     * @param string|null $baseCurrency
     *
     * @return TransactionData
     */
    public function setBaseCurrency(?string $baseCurrency): TransactionData
    {
        $this->baseCurrency = $baseCurrency;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTargetCurrency(): ?string
    {
        return $this->targetCurrency;
    }

    /**
     * @param string|null $targetCurrency
     *
     * @return TransactionData
     */
    public function setTargetCurrency(?string $targetCurrency): TransactionData
    {
        $this->targetCurrency = $targetCurrency;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float|null $amount
     *
     * @return TransactionData
     */
    public function setAmount(?float $amount): TransactionData
    {
        $this->amount = $amount;

        return $this;
    }
}
