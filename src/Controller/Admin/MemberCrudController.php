<?php

namespace App\Controller\Admin;

use App\Entity\Member;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MemberCrudController extends AbstractCrudController
{
    public function __construct(private readonly string $uploadPath, private readonly string $uploadDir)
    {
    }

    public static function getEntityFqcn(): string
    {
        return Member::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->showEntityActionsInlined();
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        yield ImageField::new('photo', 'Image')
            ->setUploadedFileNamePattern('[slug]-[randomhash].[extension]')
            ->setRequired(true)
            ->setBasePath($this->uploadPath)
            ->setUploadDir($this->uploadDir);
        yield TextField::new('lastName', 'Nom');
        yield TextField::new('firstname', 'Prénom');
        yield TextEditorField::new('resume', 'Résumé')->hideOnIndex();

    }
}
