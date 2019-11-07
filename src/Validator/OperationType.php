<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class OperationType extends Constraint
{
    public $message = 'Value "value" is not a valid operation type';
}
