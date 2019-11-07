<?php

namespace App\Validator;

use App\Dictionary\PaymentMethod;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MethodValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!PaymentMethod::isValid((int) $value)) {
            $this->context->buildViolation($constraint->message, ['value' => $value])->addViolation();
        }
    }
}
