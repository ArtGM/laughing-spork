<?php

namespace App\Tests\Repository;

use App\Repository\UserRepository;
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
    }

    public function testCount()
    {

        $container = static::getContainer();
        $user = $container->get(UserRepository::class)->count([]);
        $this->assertGreaterThanOrEqual(1, $user);
    }

}