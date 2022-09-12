<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GalleryControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Hello World');
    }
}
