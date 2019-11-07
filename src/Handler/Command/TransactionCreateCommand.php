<?php

declare(strict_types=1);

namespace App\Handler\Command;

use App\Form\Data\TransactionData;

class TransactionCreateCommand
{
    /**
     * @var TransactionData
     */
    private $transactionData;

    /**
     * @var string
     */
    private $clientIp;

    public function __construct(TransactionData $transactionData, string $clientIp)
    {
        $this->transactionData = $transactionData;
        $this->clientIp = $clientIp;
    }

    /**
     * @return int
     */
    public function getMethod(): int
    {
        return $this->transactionData->getMethod();
    }

    /**
     * @return int
     */
    public function getOperation(): int
    {
        return $this->transactionData->getOperation();
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->transactionData->getAmount();
    }

    /**
     * @return string
     */
    public function getBaseCurrency(): string
    {
        return $this->transactionData->getBaseCurrency();
    }

    /**
     * @return string
     */
    public function getTargetCurrency(): string
    {
        return $this->transactionData->getTargetCurrency();
    }

    /**
     * @return string
     */
    public function getClientIp(): string
    {
        return $this->clientIp;
    }
}
