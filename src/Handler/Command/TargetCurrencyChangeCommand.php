<?php

declare(strict_types=1);

namespace App\Handler\Command;

use App\Form\Data\TargetCurrencyChangeData;

class TargetCurrencyChangeCommand
{
    /**
     * @var TargetCurrencyChangeData
     */
    private $destinationCurrencyChangeData;

    /**
     * @var int
     */
    private $id;

    public function __construct(TargetCurrencyChangeData $destinationCurrencyChangeData, int $id)
    {
        $this->destinationCurrencyChangeData = $destinationCurrencyChangeData;
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->destinationCurrencyChangeData->getCurrency();
    }
}
