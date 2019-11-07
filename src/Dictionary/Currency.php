<?php

namespace App\Dictionary;

class Currency implements DictionaryInterface
{
    const AUSTRALIAN_DOLLAR = 'AUD';
    const BULGARIAN_LEV = 'BGN';
    const BRAZILIAN_REAL = 'BRL';
    const CANADIAN_DOLLAR = 'CAD';
    const SWISH_FRANC = 'CHF';
    const CHINESE_YUAN = 'CNY';
    const CZECH_KORUNA = 'CZK';
    const DANISH_KRONE = 'DKK';
    const EURO = 'EUR';
    const BRITISH_POUND = 'GBP';
    const HONK_KONG_DOLLAR = 'HKD';
    const CROATIAN_KRUNA = 'HRK';
    const HUNGARIAN_FORINT = 'HUF';
    const INDONESIAN_RUPIAH = 'IDR';
    const ISRAELI_NEW_SHEKEL = 'ILS';
    const INDIAN_RUPEE = 'INR';
    const ICELANDIC_KRONA = 'ISK';
    const JAPANESE_YEN = 'JPY';
    const SOUTH_KOREAN_WON = 'KRW';
    const MEXICAN_PESO = 'MXN';
    const MALAYSIAN_RINGGIT = 'MYR';
    const NORWEGIAN_KRONE = 'NOK';
    const NEW_ZEALAND_DOLLAR = 'NZD';
    const PHILIPPINE_PESO = 'PHP';
    const POLISH_ZLOTY = 'PLN';
    const ROMANIAN_LEU = 'RON';
    const RUSSIAN_RUBLE = 'RUB';
    const SWEDISH_KRONA = 'SEK';
    const SINGAPORRE_DOLLAR = 'SGD';
    const THAI_BAHT = 'THB';
    const TURKISH_LIRA = 'TRY';
    const UNITED_STATES_DOLLAR = 'USD';
    const SOUTH_AFRICAN_RAND = 'ZAR';

    const AUSTRALIAN_DOLLAR_NAME = 'AUD (Australian dollar)';
    const BULGARIAN_LEV_NAME = 'BGN (Bulgarian lev)';
    const BRAZILIAN_REAL_NAME = 'BRL (Brazilian real)';
    const CANADIAN_DOLLAR_NAME = 'CAD (Canadian dollar)';
    const SWISH_FRANC_NAME = 'CHF (Swish franc)';
    const CHINESE_YUAN_NAME = 'CNY (Chinese yuan)';
    const CZECH_KORUNA_NAME = 'CZK (Czech koruna)';
    const DANISH_KRONE_NAME = 'DKK (Danish krone)';
    const EURO_NAME = 'EUR (euro)';
    const BRITISH_POUND_NAME = 'GBP (British pound)';
    const HONK_KONG_DOLLAR_NAME = 'HKD (Honkkong dollar)';
    const CROATIAN_KRUNA_NAME = 'HRK (Coatian kruna)';
    const HUNGARIAN_FORINT_NAME = 'HUF (Hungarian forint)';
    const INDONESIAN_RUPIAH_NAME = 'IDR (Indonesian rupiah)';
    const ISRAELI_NEW_SHEKEL_NAME = 'ILS (Israeli new shekel)';
    const INDIAN_RUPEE_NAME = 'INR (Indian rupee)';
    const ICELANDIC_KRONA_NAME = 'ISK (Icelandic krona)';
    const JAPANESE_YEN_NAME = 'JPY (Japanase yen)';
    const SOUTH_KOREAN_WON_NAME = 'KRW (South Korean won)';
    const MEXICAN_PESO_NAME = 'MXN (Mexican peso)';
    const MALAYSIAN_RINGGIT_NAME = 'MYR (Malaysian ringgit)';
    const NORWEGIAN_KRONE_NAME = 'NOK (Norwegian krone)';
    const NEW_ZEALAND_DOLLAR_NAME = 'NZD (New Zealand dollar)';
    const PHILIPPINE_PESO_NAME = 'PHP (Philippine peso)';
    const POLISH_ZLOTY_NAME = 'PLN (Polish zloty)';
    const ROMANIAN_LEU_NAME = 'RON (Romanian leu)';
    const RUSSIAN_RUBLE_NAME = 'RUB (Russian ruble)';
    const SWEDISH_KRONA_NAME = 'SEK (Swedish krona)';
    const SINGAPORRE_DOLLAR_NAME = 'SGD (Singaporre dollar)';
    const THAI_BAHT_NAME = 'THB (Thai baht)';
    const TURKISH_LIRA_NAME = 'TRY (Turkish lira)';
    const UNITED_STATES_DOLLAR_NAME = 'USD (United states dollar)';
    const SOUTH_AFRICAN_RAND_NAME = 'ZAR (South african rand)';

    /**
     * {@inheritdoc}
     */
    public static function getNames(): array
    {
        return [
            self::AUSTRALIAN_DOLLAR_NAME,
            self::BULGARIAN_LEV_NAME,
            self::BRAZILIAN_REAL_NAME,
            self::CANADIAN_DOLLAR_NAME,
            self::SWISH_FRANC_NAME,
            self::CHINESE_YUAN_NAME,
            self::CZECH_KORUNA_NAME,
            self::DANISH_KRONE_NAME,
            self::EURO_NAME,
            self::BRITISH_POUND_NAME,
            self::HONK_KONG_DOLLAR_NAME,
            self::CROATIAN_KRUNA_NAME,
            self::HUNGARIAN_FORINT_NAME,
            self::INDONESIAN_RUPIAH_NAME,
            self::ISRAELI_NEW_SHEKEL_NAME,
            self::INDIAN_RUPEE_NAME,
            self::ICELANDIC_KRONA_NAME,
            self::JAPANESE_YEN_NAME,
            self::SOUTH_KOREAN_WON_NAME,
            self::MEXICAN_PESO_NAME,
            self::MALAYSIAN_RINGGIT_NAME,
            self::NORWEGIAN_KRONE_NAME,
            self::NEW_ZEALAND_DOLLAR_NAME,
            self::PHILIPPINE_PESO_NAME,
            self::POLISH_ZLOTY_NAME,
            self::ROMANIAN_LEU_NAME,
            self::RUSSIAN_RUBLE_NAME,
            self::SWEDISH_KRONA_NAME,
            self::SINGAPORRE_DOLLAR_NAME,
            self::THAI_BAHT_NAME,
            self::TURKISH_LIRA_NAME,
            self::UNITED_STATES_DOLLAR_NAME,
            self::SOUTH_AFRICAN_RAND_NAME,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getKeys(): array
    {
        return [
            self::AUSTRALIAN_DOLLAR,
            self::BULGARIAN_LEV,
            self::BRAZILIAN_REAL,
            self::CANADIAN_DOLLAR,
            self::SWISH_FRANC,
            self::CHINESE_YUAN,
            self::CZECH_KORUNA,
            self::DANISH_KRONE,
            self::EURO,
            self::BRITISH_POUND,
            self::HONK_KONG_DOLLAR,
            self::CROATIAN_KRUNA,
            self::HUNGARIAN_FORINT,
            self::INDONESIAN_RUPIAH,
            self::ISRAELI_NEW_SHEKEL,
            self::INDIAN_RUPEE,
            self::ICELANDIC_KRONA,
            self::JAPANESE_YEN,
            self::SOUTH_KOREAN_WON,
            self::MEXICAN_PESO,
            self::MALAYSIAN_RINGGIT,
            self::NORWEGIAN_KRONE,
            self::NEW_ZEALAND_DOLLAR,
            self::PHILIPPINE_PESO,
            self::POLISH_ZLOTY,
            self::ROMANIAN_LEU,
            self::RUSSIAN_RUBLE,
            self::SWEDISH_KRONA,
            self::SINGAPORRE_DOLLAR,
            self::THAI_BAHT,
            self::TURKISH_LIRA,
            self::UNITED_STATES_DOLLAR,
            self::SOUTH_AFRICAN_RAND,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getNamesMapping(): array
    {
        return array_combine(self::getNames(), self::getKeys());
    }

    /**
     * {@inheritdoc}
     */
    public static function isValid($value): bool
    {
        return in_array($value, self::getKeys());
    }
}
