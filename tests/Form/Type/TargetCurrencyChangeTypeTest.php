<?php

declare(strict_types=1);

namespace App\Tests\Form\Type;

use App\Form\Data\TargetCurrencyChangeData;
use App\Form\Type\TargetCurrencyChangeType;
use Symfony\Component\Form\Test\TypeTestCase;

class TargetCurrencyChangeTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'currency' => 'PLN',
        ];

        $objectToCompare = new TargetCurrencyChangeData();
        $form = $this->factory->create(TargetCurrencyChangeType::class, $objectToCompare);

        $dataObject = (new TargetCurrencyChangeData())->setCurrency('PLN');
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
