<?php

declare(strict_types=1);

namespace App\Gateway\Response;

class ExchangeRateResponse extends AbstractJsonResponse
{
    /**
     * {@inheritdoc}
     */
    public function isSuccessful(): bool
    {
        return !isset($this->getData()['error']) && !empty($this->getData());
    }

    /**
     * {@inheritdoc}
     */
    public function getErrorMessage(): ?string
    {
        if (empty($this->getData())) {
            return 'Connection problem';
        }

        return $this->getData()['error'] ?? null;
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return reset($this->getData()['rates']);
    }
}
