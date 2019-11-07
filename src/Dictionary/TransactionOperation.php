<?php

namespace App\Dictionary;

class TransactionOperation implements DictionaryInterface
{
    public const DEPOSIT = 0;
    public const WITHDRAWAL = 1;

    public const DEPOSIT_NAME = 'deposit';
    public const WITHDRAWAL_NAME = 'withdrawal';

    /**
     * {@inheritdoc}
     */
    public static function getNames(): array
    {
        return [
            self::DEPOSIT_NAME,
            self::WITHDRAWAL_NAME,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getKeys(): array
    {
        return [
            self::DEPOSIT,
            self::WITHDRAWAL,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getNamesMapping(): array
    {
        return array_combine(self::getNames(), self::getKeys());
    }

    public static function getNameByKey(int $key): ?string
    {
        return self::getNames()[$key] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public static function isValid($value): bool
    {
        return in_array($value, self::getKeys());
    }
}
