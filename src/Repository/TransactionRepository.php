<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Transaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TransactionRepository extends ServiceEntityRepository implements TransactionRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Transaction::class);
    }

    /**
     * {@inheritdoc}
     */
    public function fetch(int $id): ?Transaction
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public function getSearchQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('t')->orderBy('t.id', 'DESC');
    }
}
