<?php

declare(strict_types=1);

namespace App\Tests\Dictionary;

use App\Dictionary\Currency;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    public function testGetNames()
    {
        $this->assertIsArray(Currency::getNames());
    }

    public function testGetKeys()
    {
        $this->assertIsArray(Currency::getKeys());
    }

    public function testGetNamesMapping()
    {
        $this->assertIsArray(Currency::getNamesMapping());
    }

    /**
     * @dataProvider validCurrencyProvider
     *
     * @param string $currency
     */
    public function testIsValid(string $currency)
    {
        $this->assertTrue(Currency::isValid($currency));
    }

    /**
     * @return array
     */
    public function validCurrencyProvider(): array
    {
        return [
            ['EUR'],
            ['PHP'],
            ['SEK'],
        ];
    }

    /**
     * @dataProvider invalidCurrencyProvider
     *
     * @param string $currency
     */
    public function testIsValidForInvalidCurrency(string $currency)
    {
        $this->assertFalse(Currency::isValid($currency));
    }

    /**
     * @return array
     */
    public function invalidCurrencyProvider(): array
    {
        return [
            ['JS'],
            ['LLL'],
            ['ABC'],
        ];
    }
}
