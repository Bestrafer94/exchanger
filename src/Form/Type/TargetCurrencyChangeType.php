<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Dictionary\Currency;
use App\Form\Data\TargetCurrencyChangeData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TargetCurrencyChangeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('currency', ChoiceType::class, ['choices' => Currency::getNamesMapping()])
            ->setAction('/transaction')
            ->setMethod('PATCH');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TargetCurrencyChangeData::class,
        ]);
    }
}
