<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title', 'Titre')->setRequired(true);
        yield TextField::new('slug', 'Slug')->setDisabled()->onlyOnDetail();
        yield TextEditorField::new('content', 'Contenu')->hideOnIndex();
        yield TextareaField::new('shortContent', 'Extrait');
        yield TextareaField::new('metaDescription', 'Description SEO')->onlyOnForms();
    }
}
