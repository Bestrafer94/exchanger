<?php

declare(strict_types=1);

namespace App\Gateway\Response;

interface ResponseInterface
{
    /**
     * @return bool
     */
    public function isSuccessful(): bool;

    /**
     * @return string|mixed
     */
    public function getRawData();

    /**
     * @return string|null
     */
    public function getErrorMessage(): ?string;
}
