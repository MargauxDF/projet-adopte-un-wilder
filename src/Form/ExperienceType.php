<?php

namespace App\Form;

use App\Entity\Experience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('year', TextType::class, [
                'label' => 'Année ',
                'attr' => [
                    'placeholder' => 'Janvier 2015 - Mars 2020',
                ],
            ])
            ->add('title', TextType::class, [
                'label' => 'Poste ',
                'attr' => [
                    'placeholder' => 'Développeur PHP/Symfony',
                ],
            ])
            ->add('company', TextType::class, [
                'label' => 'Entreprise ',
                'attr' => [
                    'placeholder' => 'Orange',
                ],
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville ',
                'attr' => [
                    'placeholder' => 'Lyon',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description ',
                'attr' => [
                    'placeholder' => '',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
