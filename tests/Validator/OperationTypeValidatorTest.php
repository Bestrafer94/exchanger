<?php

declare(strict_types=1);

namespace App\Tests\Factory;

use App\Validator\OperationType;
use App\Validator\OperationTypeValidator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

class OperationTypeValidatorTest extends TestCase
{
    /**
     * @var OperationTypeValidator
     */
    private $operationTypeValidator;

    /**
     * @var OperationType
     */
    private $constraint;

    /**
     * @var ConstraintViolationBuilderInterface|MockObject
     */
    private $builderMock;

    /**
     * @var ExecutionContextInterface|MockObject
     */
    private $contextMock;

    protected function setUp(): void
    {
        $this->constraint = new OperationType();
        $this->builderMock = $this->createMock(ConstraintViolationBuilderInterface::class);
        $this->contextMock = $this->createMock(ExecutionContextInterface::class);
        $this->operationTypeValidator = new OperationTypeValidator();
    }

    public function testValidate()
    {
        $this->contextMock->expects($this->never())
            ->method('buildViolation')
            ->willReturn($this->builderMock);

        $this->operationTypeValidator->initialize($this->contextMock);
        $this->operationTypeValidator->validate(1, $this->constraint);
    }

    public function testValidationFailure()
    {
        $this->contextMock->expects($this->once())
            ->method('buildViolation')
            ->willReturn($this->builderMock);

        $this->operationTypeValidator->initialize($this->contextMock);
        $this->operationTypeValidator->validate(3, $this->constraint);
    }
}
