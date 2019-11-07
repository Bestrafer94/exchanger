<?php

declare(strict_types=1);

namespace App\Gateway\Request;

use App\Gateway\Model\ExchangeRatesData;
use App\Gateway\Response\ExchangeRateResponse;

class ExchangeRateRequest extends AbstractRequest
{
    /**
     * @var ExchangeRatesData
     */
    private $data;

    public function __construct(ExchangeRatesData $data)
    {
        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestTarget(): string
    {
        return 'https://api.exchangeratesapi.io/';
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestName(): string
    {
        return 'EXCHANGE RATES LIST';
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters(): string
    {
        return sprintf(
            '%s?base=%s&symbols=%s',
            $this->data->getDate(),
            $this->data->getBaseCurrency(),
            $this->data->getTargetCurrency()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getResponseClass(): string
    {
        return ExchangeRateResponse::class;
    }
}
