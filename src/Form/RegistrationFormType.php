<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', null, [
            'label' => 'Email',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Entrez votre email'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Entrez un email.',
                ]),
                new Length([
                    'min' => 3,
                    'minMessage' => 'Votre email doit faire au minimum {{ limit }} caractères.',
                ]),
                new Regex([
                    'pattern' => '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/',
                    'message' => 'Votre email doit être valide'
                ])
            ],
        ])
            ->add('password')
            ->add('username')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
