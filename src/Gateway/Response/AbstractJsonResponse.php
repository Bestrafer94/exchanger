<?php

declare(strict_types=1);

namespace App\Gateway\Response;

abstract class AbstractJsonResponse extends AbstractResponse
{
    /**
     * @var array
     */
    private $data;

    public function __construct(string $rawData = '')
    {
        parent::__construct($rawData);

        $this->data = json_decode($rawData, true) ?? [];
    }

    /**
     * @return array
     */
    protected function getData(): array
    {
        return $this->data;
    }
}
