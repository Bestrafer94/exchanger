<?php

declare(strict_types=1);

namespace App\Tests\Form\Type;

use App\Form\Data\TransactionData;
use App\Form\Type\TransactionType;
use Symfony\Component\Form\Test\TypeTestCase;

class TransactionTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'operation' => '1',
            'method' => '2',
            'baseCurrency' => 'EUR',
            'targetCurrency' => 'PLN',
            'amount' => 100.45,
        ];

        $objectToCompare = new TransactionData();
        $form = $this->factory->create(TransactionType::class, $objectToCompare);

        $dataObject = (new TransactionData())
            ->setOperation('1')
            ->setMethod('2')
            ->setBaseCurrency('EUR')
            ->setTargetCurrency('PLN')
            ->setAmount(100.45);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($dataObject, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
