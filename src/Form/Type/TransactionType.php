<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Dictionary\Currency;
use App\Dictionary\PaymentMethod;
use App\Dictionary\TransactionOperation;
use App\Form\Data\TransactionData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('operation', ChoiceType::class, ['choices' => TransactionOperation::getNamesMapping()])
            ->add('method', ChoiceType::class, ['choices' => PaymentMethod::getNamesMapping()])
            ->add('baseCurrency', ChoiceType::class, ['choices' => Currency::getNamesMapping()])
            ->add('targetCurrency', ChoiceType::class, ['choices' => Currency::getNamesMapping()])
            ->add('amount', NumberType::class)
            ->setAction('/transaction')
            ->setMethod('POST');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TransactionData::class,
        ]);
    }
}
