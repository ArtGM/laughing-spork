<?php

namespace App\Tests\Repository;

use App\DataFixtures\AppFixtures;
use App\Repository\UserRepository;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    /**
     * @var AbstractDatabaseTool
     */
    protected AbstractDatabaseTool $databaseTool;

    protected function setUp(): void
    {
        parent::setUp();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function testCount()
    {

        $container = static::getContainer();
        $this->databaseTool->loadFixtures([
            AppFixtures::class,
        ]);

        $user = $container->get(UserRepository::class)->count([]);
        $this->assertGreaterThanOrEqual(10, $user);
    }

}