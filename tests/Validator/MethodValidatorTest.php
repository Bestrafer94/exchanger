<?php

declare(strict_types=1);

namespace App\Tests\Factory;

use App\Validator\Method;
use App\Validator\MethodValidator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

class MethodValidatorTest extends TestCase
{
    /**
     * @var MethodValidator
     */
    private $methodValidator;

    /**
     * @var Method
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
        $this->constraint = new Method();
        $this->builderMock = $this->createMock(ConstraintViolationBuilderInterface::class);
        $this->contextMock = $this->createMock(ExecutionContextInterface::class);
        $this->methodValidator = new MethodValidator();
    }

    public function testValidate()
    {
        $this->contextMock->expects($this->never())
            ->method('buildViolation')
            ->willReturn($this->builderMock);

        $this->methodValidator->initialize($this->contextMock);
        $this->methodValidator->validate(2, $this->constraint);
    }

    public function testValidationFailure()
    {
        $this->contextMock->expects($this->once())
            ->method('buildViolation')
            ->willReturn($this->builderMock);

        $this->methodValidator->initialize($this->contextMock);
        $this->methodValidator->validate(8, $this->constraint);
    }
}
