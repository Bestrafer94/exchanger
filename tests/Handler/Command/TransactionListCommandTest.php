<?php

declare(strict_types=1);

namespace App\Tests\Handler\Command;

use App\Handler\Command\TransactionsListCommand;
use PHPUnit\Framework\TestCase;

class TransactionListCommandTest extends TestCase
{
    /**
     * @var TransactionsListCommand
     */
    private $transactionsListCommand;

    private $pageNumber = 4;

    protected function setUp(): void
    {
        $this->transactionsListCommand = new TransactionsListCommand($this->pageNumber);
    }

    public function testGetters()
    {
        $this->assertEquals($this->pageNumber, $this->transactionsListCommand->getPageNumber());
    }
}
