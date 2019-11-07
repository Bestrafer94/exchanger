<?php

declare(strict_types=1);

namespace App\Tests\Handler\Command;

use App\Form\Data\TargetCurrencyChangeData;
use App\Handler\Command\TargetCurrencyChangeCommand;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TargetCurrencyChangeCommandTest extends TestCase
{
    /**
     * @var TargetCurrencyChangeCommand
     */
    private $targetCurrencyChangeCommand;

    /**
     * @var TargetCurrencyChangeData|MockObject
     */
    private $targetCurrencyChangeDataMock;

    private $id = 7;

    protected function setUp(): void
    {
        $this->targetCurrencyChangeDataMock = $this->createMock(TargetCurrencyChangeData::class);

        $this->targetCurrencyChangeCommand = new TargetCurrencyChangeCommand(
            $this->targetCurrencyChangeDataMock,
            $this->id
        );
    }

    public function testGetters()
    {
        $currency = 'PLN';
        $this->targetCurrencyChangeDataMock->method('getCurrency')->willReturn($currency);

        $this->assertEquals($this->id, $this->targetCurrencyChangeCommand->getId());
        $this->assertEquals($currency, $this->targetCurrencyChangeCommand->getCurrency());
    }
}
