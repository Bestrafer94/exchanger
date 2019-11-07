<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Transaction;
use Doctrine\ORM\QueryBuilder;

interface TransactionRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return Transaction|null
     */
    public function fetch(int $id): ?Transaction;

    /**
     * @return QueryBuilder
     */
    public function getSearchQueryBuilder(): QueryBuilder;
}
