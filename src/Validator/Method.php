<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Method extends Constraint
{
    public $message = 'Value "value" is not a valid method';
}
