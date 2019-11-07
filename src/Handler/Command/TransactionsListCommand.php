<?php

declare(strict_types=1);

namespace App\Handler\Command;

class TransactionsListCommand
{
    /**
     * @var int
     */
    private $pageNumber;

    public function __construct(int $pageNumber)
    {
        $this->pageNumber = $pageNumber;
    }

    /**
     * @return int
     */
    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }
}
