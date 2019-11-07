<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Cache\RedisCacheStorage;
use PHPUnit\Framework\TestCase;

class RedisCacheStorageTest extends TestCase
{
    /**
     * @var RedisCacheStorage
     */
    private $redisCacheStorage;

    protected function setUp(): void
    {
        $this->redisCacheStorage = new RedisCacheStorage();
    }

    /**
     * @dataProvider valuesProvider
     *
     * @param string|int $value
     */
    public function testGetAndSet($value)
    {
        $this->redisCacheStorage->set('key123', $value, 1000);

        $this->assertEquals($this->redisCacheStorage->get('key123'), $value);
    }

    /**
     * @return array
     */
    public function valuesProvider(): array
    {
        return [
            ['value'],
            [123],
            [1.33],
        ];
    }

    public function testGetForInvalidKey()
    {
        $this->assertFalse($this->redisCacheStorage->get('invalid key'));
    }

    public function testHas()
    {
        $validKey = 'key';

        $this->redisCacheStorage->set($validKey, 'value', 1000);
        $this->assertFalse($this->redisCacheStorage->has('invalid key'));
        $this->assertTrue($this->redisCacheStorage->has($validKey));
    }
}
