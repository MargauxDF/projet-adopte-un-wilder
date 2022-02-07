<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('old_password', PasswordType::class, [
                'mapped' => false,
                'label' => 'Votre ancien mot de passe',
                'attr' => [
                    'placeholder' => 'Saisir votre ancien mot de passe'
                ]
            ])
            ->add(
                'new_password',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'mapped' => false,
                    'invalid_message' => 'Attention, les mots de passes ne sont pas identiques',
                    'label' => 'Votre nouveau mot de passe',
                    'constraints' => new Length([
                        'min' => 2,
                        'max' => 60
                    ]),
                    'required' => true,
                    'first_options' => ['label' => 'Votre nouveau mot de passe',
                        'attr' => [
                            'placeholder' => 'Saisir votre nouveau mot de passe'
                        ]
                    ],
                    'second_options' => ['label' => 'Confirmation du nouveau mot de passe',
                        'attr' => [
                            'placeholder' => 'Confirmer votre nouveau mot de passe'
                        ]
                    ]
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                [
                    'label' => 'Modifier mot de passe'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
