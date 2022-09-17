<?php

namespace App\Controller\Admin;

use App\Entity\Concert;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ConcertCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Concert::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title', 'Nom');
        yield TextEditorField::new('description', 'Description')->hideOnIndex();
        yield DateField::new('date', 'Date');
        yield TextField::new('place', 'Lieu');
    }

}
