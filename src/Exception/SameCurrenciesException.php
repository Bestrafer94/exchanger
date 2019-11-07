<?php

declare(strict_types=1);

namespace App\Exception;

class SameCurrenciesException extends \Exception
{
    protected $message = 'Currencies cannot be the same!';
}
