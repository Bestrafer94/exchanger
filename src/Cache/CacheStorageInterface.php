<?php

declare(strict_types=1);

namespace App\Cache;

interface CacheStorageInterface
{
    /**
     * @param string $key
     * @param mixed $value
     * @param int $expiration
     *
     * @return bool
     */
    public function set(string $key, $value, int $expiration): bool;

    /**
     * @param string $key
     *
     * @return bool|mixed
     */
    public function get(string $key);

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool;
}
