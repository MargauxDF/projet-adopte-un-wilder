<?php

namespace App\Controller\Admin;

use App\Entity\Education;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EducationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Education::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('year'),
            TextField::new('title'),
            TextField::new('school'),
            TextField::new('city'),
            TextareaField::new('description'),
            AssociationField::new('user')
        ];
    }
}
