<?php

declare(strict_types=1);

namespace App\Exception;

class TransactionNotFoundException extends \Exception
{
    protected $message = 'Transaction with given id not found!';
}
