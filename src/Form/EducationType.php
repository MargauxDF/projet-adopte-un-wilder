<?php

namespace App\Form;

use App\Entity\Education;
use phpDocumentor\Reflection\DocBlock\Description;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EducationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'year',
                TextType::class,
                [
                    'label' => 'Année :',
                    'attr' => [
                        'placeholder' => 'ex : Septembre 2019 - Juin 2020',
                    ]
                ]
            )
            ->add(
                'title',
                TextType::class,
                [
                    'label' => 'Titre :',
                    'attr' => [
                        'placeholder' => 'ex : Développeur web et mobile',
                    ]
                ]
            )
            ->add(
                'school',
                TextType::class,
                [
                    'label' => 'Nom de l\'école :',
                    'attr' => [
                        'placeholder' =>  'ex : Wild Code School',
                    ]
                ]
            )
            ->add(
                'city',
                TextType::class,
                [
                    'label' => 'Ville :',
                    'attr' => [
                        'placeholder' => 'ex : Lyon',
                    ]
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'required' => false,
                    'label' => 'Description :',
                    'attr' => [
                        'placeholder' => 'Détaillez ici le contenu de votre formation',
                    ]
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Education::class,
        ]);
    }
}
