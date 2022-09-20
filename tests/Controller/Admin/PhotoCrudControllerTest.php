<?php

namespace App\Tests\Controller\Admin;

use App\Controller\Admin\PhotoCrudController;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class PhotoCrudControllerTest extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{

    public function testManagePhotoIsSuccessful(): void
    {
        $client = static::createClient();

        $entityManager = $client->getContainer()->get("doctrine.orm.entity_manager");

        $adminUrlGenerator = $client->getContainer()->get(AdminUrlGenerator::class);

        $admin = $entityManager->getRepository(User::class)->findOneByEmail('admin@email.com');

        $client->loginUser($admin);

        $client->request(
            "GET",
            $adminUrlGenerator
                ->setController(PhotoCrudController::class)
                ->setAction(Action::INDEX)
                ->generateUrl()
        );

        self::assertResponseIsSuccessful();

        $client->request(
            "GET",
            $adminUrlGenerator
                ->setController(PhotoCrudController::class)
                ->setAction(Action::NEW)
                ->generateUrl()
        );

        self::assertResponseIsSuccessful();

        // TODO Test File Upload
    }

}