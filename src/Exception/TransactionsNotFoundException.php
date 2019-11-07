<?php

declare(strict_types=1);

namespace App\Exception;

class TransactionsNotFoundException extends \Exception
{
    protected $message = 'Transactions not found!';
}
