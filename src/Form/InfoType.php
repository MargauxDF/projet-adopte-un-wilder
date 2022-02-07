<?php

namespace App\Form;

use App\Entity\LabelCv;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom de famille'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse Mail'
            ])
            ->add('telephone', TextType::class, [
                'required'   => false,
            ])
            ->add('labelCv', EntityType::class, [
                'class' => LabelCv::class,
                'choice_label' => 'title',
                'expanded' => true,
            ])
            ->add('presentation')
            ->add('picture', FileType::class, [
                'label' => 'Photo ou Avatar ( .jpg, .jpeg, .png )',
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,])
            ->add('linkedin', UrlType::class, [
                'required'   => false,
                'attr' => [
                    'placeholder' => 'Profil Linkedin',
                ],
            ])
            ->add('github', UrlType::class, [
                'required'   => false,
                'attr' => [
                    'placeholder' => 'Profil Github',
                ],
            ])
            ->add('twitter', UrlType::class, [
                'required'   => false,
                'attr' => [
                    'placeholder' => 'Profil Twitter',
                ],
            ])
            ->add('portfolio', UrlType::class, [
                'required'   => false,
                'attr' => [
                    'placeholder' => '( http(s)://... )',
                ],
            ])

            ->add('isAdopted', CheckboxType::class, [
                'label' => 'Adopté.e',
                'required' => false,
                'row_attr' => [
                    'class' => 'form-switch',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
