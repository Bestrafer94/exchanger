<?php

namespace App\Validator;

use App\Dictionary\Currency;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CurrencyValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!Currency::isValid($value)) {
            $this->context->buildViolation($constraint->message, ['value' => $value])->addViolation();
        }
    }
}
