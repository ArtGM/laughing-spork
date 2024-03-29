<?php

namespace App\DataFixtures;

use App\Entity\Concert;
use App\Entity\Gallery;
use App\Entity\Page;
use App\Entity\Photo;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new \Xvladqt\Faker\LoremFlickrProvider($faker));

        $admin = new User();
        $password = $this->userPasswordHasher->hashPassword($admin, 'password');
        $admin->setUsername('admin');
        $admin->setEmail('admin@email.com');
        $admin->setPassword($password);
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        for ($i = 0; $i < 50; ++$i) {
            $concert = new Concert();
            $concert->setTitle($faker->sentence(3));
            $concert->setDate($faker->dateTimeBetween('-1 years', '+1 years'));
            $concert->setPlace($faker->city());
            $concert->setDescription($faker->paragraph(3));
            $manager->persist($concert);
        }

        for ($i = 0; $i < 5; ++$i) {
            $page = new Page();
            $page->setTitle($faker->sentence(2));
            $page->setContent($faker->paragraph(5));
            $page->setSlug($faker->slug());
            $page->setMetaDescription($faker->sentence(5));
            $page->setShortContent($faker->paragraph(1));
            $manager->persist($page);
        }

        $gallery = new Gallery();

        for ($i = 0; $i < 50; ++$i) {
            $file = new File($faker->image(null, 640, 480, ['music']));
            $file->move('public/uploads', $file->getFilename());
            $photo = new Photo();
            $photo->setTitle($faker->sentence(3));
            $photo->setFile($file);
            $photo->setImage($file->getFilename());
            $gallery->addImage($photo);
        }

        $manager->persist($gallery);
        $manager->flush();
    }
}
