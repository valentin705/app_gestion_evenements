<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class EventFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de début',
                // 'required' => false,
                // 'empty_data' => null,
                // 'format' => 'yyyy-MM-dd',
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de fin',
                // 'required' => false,
                // 'empty_data' => null,
                // 'format' => 'yyyy-MM-dd',
            ])
            ->add('filter', SubmitType::class, ['label' => 'Filtrer'])
            ->add('reset', ButtonType::class, [
                'label' => 'Réinitialiser',
                'attr' => [
                    'onclick' => 'window.location.href=\'/home\'; return false;',
                ]
            ]);
    }
}