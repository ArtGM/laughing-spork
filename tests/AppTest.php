<?php

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppTest extends WebTestCase
{


    public function testApp(): void
    {
        $this->assertEquals(3, 2 + 1);
    }
}