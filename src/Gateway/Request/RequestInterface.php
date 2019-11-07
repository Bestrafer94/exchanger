<?php

namespace App\Gateway\Request;

interface RequestInterface
{
    /**
     * @return string
     */
    public function getRequestTarget(): string;

    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @return string
     */
    public function getParameters(): string;

    /**
     * @return string[][]
     */
    public function getHeaders(): array;

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasHeader(string $name): bool;

    /**
     * @param string $name
     *
     * @return string[]
     */
    public function getHeader(string $name): array;

    /**
     * @return string
     */
    public function getRequestName(): string;

    /**
     * @return string
     */
    public function getResponseClass(): string;
}
