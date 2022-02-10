<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname'),
            TextField::new('lastname'),
            TextField::new('slug'),
            EmailField::new('email'),
            TextField::new('password'),
            //TextareaField::new('presentation'),
            ImageField::new('picturefilename')
                ->setBasePath('uploads/pictures/')
                ->setUploadDir('public/uploads/pictures/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TelephoneField::new('telephone'),
            //UrlField::new('linkedin'),
            //UrlField::new('github'),
            //UrlField::new('twitter'),
            //UrlField::new('portfolio'),
            AssociationField::new('skills'),
            AssociationField::new('experiences'),
            AssociationField::new('educations'),
            ArrayField::new('roles'),
            BooleanField::new('isAdopted')
        ];
    }
}
