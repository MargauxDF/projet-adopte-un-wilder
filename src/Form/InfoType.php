<?php

namespace App\Form;

use App\Entity\LabelCv;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('telephone')
            ->add('labelCv', EntityType::class, [
                'class' => LabelCv::class,
                'choice_label' => 'title',
                'expanded' => true,
            ])
            ->add('presentation')
            ->add('picture', FileType::class, [
                'label' => 'Picture (Image file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                /*'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/jpg',
                            'application/jpeg',
                            'application/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid picture',
                    ])
                ],*/
            ])
            ->add('linkedin')
            ->add('github')
            ->add('twitter')
            ->add('portfolio')
            ->add('isAdopted', ChoiceType::class, [
                'label' => 'Etes-vous toujours à la recherche d\'un employeur ?',
                'data' => false,
                'choices' => [
                    'Oui' => false,
                    'Non' => true,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
