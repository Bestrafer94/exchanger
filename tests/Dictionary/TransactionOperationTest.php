<?php

declare(strict_types=1);

namespace App\Tests\Dictionary;

use App\Dictionary\TransactionOperation;
use PHPUnit\Framework\TestCase;

class TransactionOperationTest extends TestCase
{
    public function testGetNames()
    {
        $this->assertIsArray(TransactionOperation::getNames());
    }

    public function testGetKeys()
    {
        $this->assertIsArray(TransactionOperation::getKeys());
    }

    public function testGetNamesMapping()
    {
        $this->assertIsArray(TransactionOperation::getNamesMapping());
    }

    public function testGetNameByKey()
    {
        $this->assertEquals(
            TransactionOperation::DEPOSIT_NAME,
            TransactionOperation::getNameByKey(TransactionOperation::DEPOSIT)
        );
        $this->assertEquals(
            TransactionOperation::WITHDRAWAL_NAME,
            TransactionOperation::getNameByKey(TransactionOperation::WITHDRAWAL)
        );
    }

    /**
     * @dataProvider validOperationProvider
     *
     * @param int $operation
     */
    public function testIsValid(int $operation)
    {
        $this->assertTrue(TransactionOperation::isValid($operation));
    }

    /**
     * @return array
     */
    public function validOperationProvider(): array
    {
        return [
            [0],
            [1],
        ];
    }

    /**
     * @dataProvider invalidOperationProvider
     *
     * @param int $operation
     */
    public function testIsValidForInvalidCurrency(int $operation)
    {
        $this->assertFalse(TransactionOperation::isValid($operation));
    }

    /**
     * @return array
     */
    public function invalidOperationProvider(): array
    {
        return [
            [2],
            [3],
            [-1],
        ];
    }
}
