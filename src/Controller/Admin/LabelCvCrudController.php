<?php

namespace App\Controller\Admin;

use App\Entity\LabelCv;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LabelCvCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LabelCv::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
