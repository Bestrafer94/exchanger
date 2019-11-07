<?php

declare(strict_types=1);

namespace App\Gateway\Response;

abstract class AbstractResponse implements ResponseInterface
{
    /**
     * @var string
     */
    private $rawData;

    public function __construct(string $rawData = '')
    {
        $this->rawData = $rawData;
    }

    /**
     * {@inheritdoc}
     */
    public function getRawData(): string
    {
        return $this->rawData;
    }
}
