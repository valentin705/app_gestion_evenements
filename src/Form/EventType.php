<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
// use Symfony\Component\Validator\Constraints\GreaterThan;
// use Symfony\Component\Validator\Constraints as Assert;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', null, [
            'label' => 'Titre',
            'attr' => ['class' => 'form-control'],
        ])
        ->add('description', null, [
            'label' => 'Description',
            'attr' => ['class' => 'form-control'],
        ])
        ->add('startDateTime', DateType::class, [
            'widget' => 'single_text',
            'label' => 'Date de début',
            'attr' => ['class' => 'form-control'],
        ])
        ->add('endDateTime', DateType::class, [
            'widget' => 'single_text',
            'label' => 'Date de fin',
            'attr' => ['class' => 'form-control'],
            // 'constraints' => [
            //     new Assert\GreaterThan([
            //         'propertyPath' => 'parent["startDateTime"]',
            //         'message' => 'La date de fin doit être postérieure à la date de début.'
            //     ]),
            // ],
        ])
        ->add('location', null, [
            'label' => 'Lieu',
            'attr' => ['class' => 'form-control'],
        ]);
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
