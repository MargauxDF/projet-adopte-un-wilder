<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom du Projet ',
                'required' => false,
            ])
            ->add('picture', FileType::class, [
                'label' => 'Screenshot ( .jpg, .jpeg, .png )',
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,])
            ->add('url', UrlType::class, [
                'label' => 'Lien vers projet ',
                'required' => false,
            ])
            ->add('github', UrlType::class, [
                'label' => 'Lien Github ',
                'required' => false,
            ])
            ->add('description', TextType::class, [
                'label' => 'Techno utilisé ',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
