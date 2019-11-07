<?php

declare(strict_types=1);

namespace App\Tests\Factory;

use App\Validator\CurrencyValidator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\Currency;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

class CurrencyValidatorTest extends TestCase
{
    /**
     * @var CurrencyValidator
     */
    private $currencyValidator;

    /**
     * @var Currency
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
        $this->constraint = new Currency();
        $this->builderMock = $this->createMock(ConstraintViolationBuilderInterface::class);
        $this->contextMock = $this->createMock(ExecutionContextInterface::class);
        $this->currencyValidator = new CurrencyValidator();
    }

    public function testValidate()
    {
        $this->contextMock->expects($this->never())
            ->method('buildViolation')
            ->willReturn($this->builderMock);

        $this->currencyValidator->initialize($this->contextMock);
        $this->currencyValidator->validate('EUR', $this->constraint);
    }

    public function testValidationFailure()
    {
        $this->contextMock->expects($this->once())
            ->method('buildViolation')
            ->willReturn($this->builderMock);

        $this->currencyValidator->initialize($this->contextMock);
        $this->currencyValidator->validate('invalid', $this->constraint);
    }
}
