<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PhotoCrudController extends AbstractCrudController
{

    public function __construct(private readonly string $uploadPath, private readonly string $uploadDir)
    {
    }

    public static function getEntityFqcn(): string
    {
        return Photo::class;
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
        $uploadPath = $this->uploadPath;
        $uploadDir = $this->uploadDir;

        yield TextField::new('title', 'Titre');
        $imageField = ImageField::new('image', 'Image')
            ->setUploadedFileNamePattern('[slug]-[randomhash].[extension]')
            ->setRequired(true)
            ->setBasePath($uploadPath)
            ->setUploadDir($uploadDir);
        if ($pageName === Crud::PAGE_EDIT) {
           $imageField->setRequired(false);
        }

        yield $imageField;
    }

}
