<?php

namespace App\Tests\Action;

use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;

class LoginActionTest extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{


    public function testLogin(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        self::assertResponseIsSuccessful();
    }

    public function testLoginWithBadCredentials(): void
    {
        $client = static::createClient();
        $adminUrlGenerator = $client->getContainer()->get(AdminUrlGenerator::class);
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Connexion')->form([
            'email' => 'user@bademail.com',
            'password' => 'badpassword',
        ]);
        $client->submit($form);

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        self::assertSelectorTextContains('div.alert.alert-danger', 'Invalid credentials.');
    }

    public function testLoginWithGoodCredentials(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Connexion')->form([
            'email' => 'admin@email.com',
            'password' => 'password',
        ]);
        $client->submit($form);
        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        self::assertSelectorTextContains('span.menu-item-label', 'Tableau de bord');
    }
}