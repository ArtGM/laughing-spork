<?php

namespace App\Controller\Admin;

use App\Entity\Concert;
use App\Entity\Gallery;
use App\Entity\Member;
use App\Entity\Page;
use App\Entity\Photo;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToCrud('Membres', 'fas fa-users', Member::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', User::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Concerts', 'fa fa-guitar', Concert::class);
        yield MenuItem::linkToCrud('Pages', 'fa fa-file', Page::class);
        yield MenuItem::subMenu('Médiathèque', 'fa fa-images')->setSubItems([
            MenuItem::linkToCrud('Galeries Photos', 'fa fa-images', Gallery::class),
            MenuItem::linkToCrud('Créer une galerie', 'fa fa-plus', Gallery::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Images', 'fa fa-images', Photo::class),
            MenuItem::linkToCrud('Ajouter une image', 'fa fa-plus', Photo::class)->setAction(Crud::PAGE_NEW),
        ]);
    }

}
