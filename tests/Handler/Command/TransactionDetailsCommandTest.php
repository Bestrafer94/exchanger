<?php

declare(strict_types=1);

namespace App\Tests\Handler\Command;

use App\Handler\Command\TransactionDetailsCommand;
use PHPUnit\Framework\TestCase;

class TransactionDetailsCommandTest extends TestCase
{
    /**
     * @var TransactionDetailsCommand
     */
    private $transactionDetailsCommand;

    private $id = 7;

    protected function setUp(): void
    {
        $this->transactionDetailsCommand = new TransactionDetailsCommand($this->id);
    }

    public function testGetters()
    {
        $this->assertEquals($this->id, $this->transactionDetailsCommand->getId());
    }
}
