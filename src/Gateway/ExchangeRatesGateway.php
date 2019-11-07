<?php

declare(strict_types=1);

namespace App\Gateway;

use App\Gateway\Model\ExchangeRatesData;
use App\Gateway\Request\ExchangeRateRequest;
use App\Gateway\Response\ExchangeRateResponse;

class ExchangeRatesGateway extends AbstractGateway
{
    /**
     * @param ExchangeRatesData $data
     *
     * @return ExchangeRateResponse
     */
    public function getExchangeRate(ExchangeRatesData $data): ExchangeRateResponse
    {
        $request = new ExchangeRateRequest($data);

        /** @var ExchangeRateResponse $response */
        $response = $this->client->execute($request);

        return $response;
    }
}
