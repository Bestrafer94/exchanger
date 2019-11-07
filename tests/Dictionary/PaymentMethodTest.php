<?php

declare(strict_types=1);

namespace App\Tests\Dictionary;

use App\Dictionary\PaymentMethod;
use PHPUnit\Framework\TestCase;

class PaymentMethodTest extends TestCase
{
    public function testGetNames()
    {
        $this->assertIsArray(PaymentMethod::getNames());
    }

    public function testGetKeys()
    {
        $this->assertIsArray(PaymentMethod::getKeys());
    }

    public function testGetNamesMapping()
    {
        $this->assertIsArray(PaymentMethod::getNamesMapping());
    }

    public function testGetNameByKey()
    {
        $this->assertEquals(
            PaymentMethod::BANK_TRANSFER_NAME,
            PaymentMethod::getNameByKey(PaymentMethod::BANK_TRANSFER)
        );
        $this->assertEquals(
            PaymentMethod::CARD_NAME,
            PaymentMethod::getNameByKey(PaymentMethod::CARD)
        );
        $this->assertEquals(
            PaymentMethod::EWALLET_NAME,
            PaymentMethod::getNameByKey(PaymentMethod::EWALLET)
        );
        $this->assertEquals(
            PaymentMethod::VOUCHER_NAME,
            PaymentMethod::getNameByKey(PaymentMethod::VOUCHER)
        );
    }

    /**
     * @dataProvider validMethodProvider
     *
     * @param int $method
     */
    public function testIsValid(int $method)
    {
        $this->assertTrue(PaymentMethod::isValid($method));
    }

    /**
     * @return array
     */
    public function validMethodProvider(): array
    {
        return [
            [0],
            [1],
            [3],
        ];
    }

    /**
     * @dataProvider invalidMethodProvider
     *
     * @param int $method
     */
    public function testIsValidForInvalidCurrency(int $method)
    {
        $this->assertFalse(PaymentMethod::isValid($method));
    }

    /**
     * @return array
     */
    public function invalidMethodProvider(): array
    {
        return [
            [9],
            [4],
            [-1],
        ];
    }
}
