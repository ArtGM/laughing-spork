<?php

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppTest extends WebTestCase
{


    public function testApp()
    {
        $this->assertEquals(3, 2 + 1);
    }
}