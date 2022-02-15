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
                    'Node.js' => 'https://cdn-icons-png.flaticon.com/512/919/919825.png',
                    'Spring' => 'https://image.pngaaa.com/238/5473238-middle.png',
                    'Git' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Git_icon.svg/1024px-Git_icon.svg.png',
                    'Python' => 'https://cdn-icons-png.flaticon.com/512/919/919852.png',
                    'MySql' => 'https://cdn-icons-png.flaticon.com/512/919/919836.png',
                    'PostgreSql' => 'https://icon-library.com/images/postgresql-icon/postgresql-icon-12.jpg',
                    'MongoDB' => 'https://www.pngitem.com/pimgs/m/385-3850320_png-transparent-mongodb-icon-mongodb-logo-png-download.png',
                    'PySpark' => 'https://miro.medium.com/max/800/1*nPcdyVwgcuEZiEZiRqApug.jpeg',
                    'ElasticSearch' => 'https://cdn.iconscout.com/icon/free/png-256/elasticsearch-226094.png',
            ]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Skill::class,
        ]);
    }
}
