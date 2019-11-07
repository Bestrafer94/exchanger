<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Currency extends Constraint
{
    public $message = 'Value "value" is not a valid currency';
}
