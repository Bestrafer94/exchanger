<?php

declare(strict_types=1);

namespace App\Cache;

use Redis;

class RedisCacheStorage implements CacheStorageInterface
{
    /**
     * @var Redis
     */
    protected $cache;

    public function __construct()
    {
        $this->cache = new Redis();
        $this->cache->connect('redis');
    }

    public function __destruct()
    {
        $this->cache->close();
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $key, $value, int $expiration): bool
    {
        $result = $this->cache->set($key, $value, $expiration);

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key)
    {
        return $this->cache->get($key);
    }

    /**
     * {@inheritdoc}
     */
    public function has(string $key): bool
    {
        return (bool) $this->cache->exists($key);
    }
}
