<?php

namespace App\Validator;

use App\Dictionary\TransactionOperation;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class OperationTypeValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!TransactionOperation::isValid((int) $value)) {
            $this->context->buildViolation($constraint->message, ['value' => $value])->addViolation();
        }
    }
}
