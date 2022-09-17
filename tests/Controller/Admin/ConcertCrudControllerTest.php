<?php

namespace App\Tests\Controller\Admin;

use App\Controller\Admin\ConcertCrudController;
use App\Entity\Concert;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ConcertCrudControllerTest extends WebTestCase
{

        public function testIfConcertManageIsSuccessful(): void
    {
        $client = static::createClient();

        $entityManager = $client->getContainer()->get("doctrine.orm.entity_manager");


        $adminUrlGenerator = $client->getContainer()->get(AdminUrlGenerator::class);

        $admin = $entityManager->getRepository(User::class)->findOneByEmail('admin@email.com');

        $client->loginUser($admin);
        $client->request(
            "GET",
            $adminUrlGenerator
                ->setController(ConcertCrudController::class)
                ->setAction(Action::INDEX)
                ->generateUrl()
        );

        self::assertResponseIsSuccessful();

        $crawler = $client->request(
            "GET",
            $adminUrlGenerator
                ->setController(ConcertCrudController::class)
                ->setAction(Action::NEW)
                ->generateUrl()
        );

        self::assertResponseIsSuccessful();


        $client->submitForm('Créer', [
            'Concert[title]' => 'Concert de test',
            'Concert[description]' => 'Description de test',
            'Concert[date]' => '2021-12-12',
            'Concert[place]' => 'Paris',
        ]);

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $concert = $entityManager->getRepository(Concert::class)->findOneBy(["title" => "Concert de test"]);

        $client->request(
            "GET",
            $adminUrlGenerator
                ->setController(ConcertCrudController::class)
                ->setAction(Action::EDIT)
                ->setEntityId($concert->getId())
                ->generateUrl()
        );

        self::assertResponseIsSuccessful();

        $client->submitForm("Sauvegarder", [
            "Concert[title]" => "Titre",
            "Concert[description]" => "lorem ipsum sit dolor amet",
            "Concert[date]" => '2023-01-01',
            "Concert[place]" => "Paris",
        ]);

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $concert = $entityManager->getRepository(Concert::class)->findOneBy(["title" => "Titre"]);
        $client->request(
            "GET",
            $adminUrlGenerator
                ->setController(ConcertCrudController::class)
                ->setAction(Action::DELETE)
                ->setEntityId($concert->getId())
                ->generateUrl()
        );

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);

    }



}
