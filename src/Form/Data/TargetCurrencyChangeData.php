<?php

declare(strict_types=1);

namespace App\Form\Data;

use App\Validator\Currency;

class TargetCurrencyChangeData
{
    /**
     * @var string|null
     *
     * @Currency()
     */
    protected $currency;

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     *
     * @return TargetCurrencyChangeData
     */
    public function setCurrency(?string $currency): TargetCurrencyChangeData
    {
        $this->currency = $currency;

        return $this;
    }
}
