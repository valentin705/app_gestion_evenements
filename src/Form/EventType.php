<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
// use Symfony\Component\Validator\Constraints\GreaterThan;
// use Symfony\Component\Validator\Constraints as Assert;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', null, [
            'label' => 'Titre',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Entrez le titre de l\'événement'],
        ])
        ->add('description', null, [
            'label' => 'Description',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Entrez la description de l\'événement'],
        ])
        ->add('startDateTime', DateTimeType::class, [
            'widget' => 'single_text',
            'label' => 'Date et heure de début',
            'attr' => ['class' => 'form-control datetimeppicker'],
        ])
        ->add('endDateTime', DateTimeType::class, [
            'widget' => 'single_text',
            'label' => 'Date et heure de fin',
            'attr' => ['class' => 'form-control datetimeppicker'],
        ])
        ->add('location', null, [
            'label' => 'Lieu',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Entrez le lieu de l\'événement'],
        ]);
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
