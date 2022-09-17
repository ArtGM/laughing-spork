<?php

namespace App\Tests\Controller\Admin;

use App\Controller\Admin\PageCrudController;
use App\Entity\Page;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageCrudControllerTest extends WebTestCase
{
    public function testIfPageManageIsSuccessful(): void
    {
        $client = static::createClient();

        $entityManager = $client->getContainer()->get("doctrine.orm.entity_manager");

        $adminUrlGenerator = $client->getContainer()->get(AdminUrlGenerator::class);

        $admin = $entityManager->getRepository(User::class)->findOneByEmail('admin@email.com');

        $client->loginUser($admin);

        $client->request(
            "GET",
            $adminUrlGenerator
                ->setController(PageCrudController::class)
                ->setAction(Action::INDEX)
                ->generateUrl()
        );

        self::assertResponseIsSuccessful();

        $crawler = $client->request(
            "GET",
            $adminUrlGenerator
                ->setController(PageCrudController::class)
                ->setAction(Action::NEW)
                ->generateUrl()
        );

        self::assertResponseIsSuccessful();

        $client->submitForm('Créer', [
            'Page[title]' => 'Page de test',
            'Page[content]' => 'Contenu de test',
        ]);

        self::assertResponseIsSuccessful();
        $page = $entityManager->getRepository(Page::class)->findOneBy(["title" => "Page de test"]);
        $client->request(
            "GET",
            $adminUrlGenerator
                ->setController(PageCrudController::class)
                ->setAction(Action::EDIT)
                ->setEntityId($page->getId())
                ->generateUrl()
        );

        self::assertResponseIsSuccessful();

        $client->submitForm('Enregistrer', [
            'Page[title]' => 'Page de test modifiée',
            'Page[content]' => 'Contenu de test modifié',
        ]);

        self::assertResponseIsSuccessful();
        $page = $entityManager->getRepository(Page::class)->findOneBy(["title" => "Page de test modifiée"]);
        $client->request(
            "GET",
            $adminUrlGenerator
                ->setController(PageCrudController::class)
                ->setAction(Action::DELETE)
                ->setEntityId($page->getId())
                ->generateUrl()
        );

        self::assertResponseIsSuccessful();

    }
}
