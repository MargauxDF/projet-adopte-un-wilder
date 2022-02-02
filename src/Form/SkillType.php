<?php

namespace App\Form;

use App\Entity\Skill;
use Hoa\Compiler\Llk\Rule\Choice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('url', ChoiceType::class, [
                'label' => 'Compétence ',
                'choices' => [
                    'PHP' => 'https://cdn-icons-png.flaticon.com/512/919/919830.png',
                    'HTML' => 'https://cdn-icons-png.flaticon.com/512/919/919827.png',
                    'CSS' => 'https://cdn-icons-png.flaticon.com/512/919/919826.png',
                    'Symfony' => 'https://symfony.com/logos/symfony_black_03.png',
                    'JavaScript' => 'https://www.freepnglogos.com/uploads/javascript-png/javascript-vector-logo-yellow-png-transparent-javascript-vector-12.png',
                    'Angular' => 'https://cdn4.iconfinder.com/data/icons/logos-and-brands/512/21_Angular_logo_logos-512.png',

                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Skill::class,
        ]);
    }
}
