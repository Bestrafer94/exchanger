<?php

declare(strict_types=1);

namespace App\Gateway\Model;

class ExchangeRatesData
{
    /**
     * @var string
     */
    private $date;

    /**
     * @var string
     */
    private $baseCurrency;

    /**
     * @var string
     */
    private $targetCurrency;

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     *
     * @return ExchangeRatesData
     */
    public function setDate(string $date): ExchangeRatesData
    {
        $this->date = $date;

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
     * @return ExchangeRatesData
     */
    public function setBaseCurrency(string $baseCurrency): ExchangeRatesData
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
     * @return ExchangeRatesData
     */
    public function setTargetCurrency(string $targetCurrency): ExchangeRatesData
    {
        $this->targetCurrency = $targetCurrency;

        return $this;
    }
}
