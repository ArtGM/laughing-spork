<?php

namespace App\Tests\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexActionTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Hello World');
    }
}
