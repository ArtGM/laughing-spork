<?php

namespace App\Tests\Controller\Admin;

use App\Controller\Admin\PageCrudController;
use App\Entity\Page;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

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

        $client->request(
            "GET",
            $adminUrlGenerator
                ->setController(PageCrudController::class)
                ->setAction(Action::NEW)
                ->generateUrl()
        );

        self::assertResponseIsSuccessful();

        $client->submitForm('Créer', [
            'Page[title]' => 'Page de test',
            'Page[content]' => 'Contenu de test', // TODO: implements visual editor
            'Page[shortContent]' => 'Extrait de test',
            'Page[metaDescription]' => 'Description SEO de test',
        ]);

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);

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

        $client->submitForm('Sauvegarder', [
            'Page[title]' => 'Page de test modifiée',
            'Page[content]' => 'Contenu de test modifié',
            'Page[shortContent]' => 'Extrait de test modifié',
            'Page[metaDescription]' => 'Description SEO de test modifiée',
        ]);

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->request(
            "GET",
            $adminUrlGenerator
                ->setController(PageCrudController::class)
                ->setAction(Action::DELETE)
                ->setEntityId($page->getId())
                ->generateUrl()
        );

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);

    }
}
