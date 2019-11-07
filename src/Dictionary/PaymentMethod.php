<?php

namespace App\Dictionary;

class PaymentMethod implements DictionaryInterface
{
    const BANK_TRANSFER = 0;
    const CARD = 1;
    const EWALLET = 2;
    const VOUCHER = 3;

    const BANK_TRANSFER_NAME = 'bank transfer';
    const CARD_NAME = 'card';
    const EWALLET_NAME = 'ewallet';
    const VOUCHER_NAME = 'voucher';

    /**
     * {@inheritdoc}
     */
    public static function getNames(): array
    {
        return [
            self::BANK_TRANSFER_NAME,
            self::CARD_NAME,
            self::EWALLET_NAME,
            self::VOUCHER_NAME,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getKeys(): array
    {
        return [
            self::BANK_TRANSFER,
            self::CARD,
            self::EWALLET,
            self::VOUCHER,
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
