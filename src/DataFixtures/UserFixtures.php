<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory as Faker;

class UserFixtures extends Fixture
{
    private $passHasher;

    public function __construct(UserPasswordHasherInterface $passHasher)
    {
        $this->passHasher = $passHasher;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker::create('fr_FR');

        $user = new User();
        $user->setEmail('user@mail.com');
        $user->setPassword($this->passHasher->hashPassword($user,'password'));
        $user->setFirstname('User');
        $user->setLastname('Test');
        //role by default is ROLE_USER so is ok
        $manager->persist($user);

        $company1 = new Company();
        $company1->setName('Ets '.$faker->company());
        $company1->setUser($user);
        $manager->persist($company1);

        $company2 = new Company();
        $company2->setName('Ets '.$faker->company());
        $company2->setUser($user);
        $manager->persist($company2);

        for ($n=1; $n<30; $n++){
            $user = new User();
            $user->setEmail($faker->email());
            $user->setPassword($this->passHasher->hashPassword($user, 'password'));
            $user->setFirstname($faker->firstName());
            $user->setLastname($faker->lastName());
            $manager->persist($user);

            $company = new Company();
            $company->setName('Ets '.$faker->company());
            $company->setUser($user);
            $manager->persist($company);
        }
        $manager->flush();
    }
}
