<?php

declare(strict_types=1);

namespace App\Gateway\Request;

abstract class AbstractRequest implements RequestInterface
{
    /**
     * {@inheritdoc}
     */
    public function getMethod(): string
    {
        return 'GET';
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters(): string
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function hasHeader(string $name): bool
    {
        return in_array($name, $this->getHeaders(), true);
    }

    /**
     * {@inheritdoc}
     */
    public function getHeader(string $name): array
    {
        $header = $this->getHeaders()[$name] ?? [];

        if (!is_array($header)) {
            $header = [$header];
        }

        return $header;
    }
}
