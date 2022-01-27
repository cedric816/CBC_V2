<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passHasher;

    public function __construct(UserPasswordHasherInterface $passHasher)
    {
        $this->passHasher = $passHasher;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('user@mail.com');
        $user->setPassword($this->passHasher->hashPassword($user,'password'));
        $user->setFirstname('User');
        $user->setLastname('Test');
        //role by default is ROLE_USER so is ok
        $manager->persist($user);

        $company1 = new Company();
        $company1->setName('ma première entreprise');
        $company1->setUser($user);
        $manager->persist($company1);

        $company2 = new Company();
        $company2->setName('ma deuxième entreprise');
        $company2->setUser($user);
        $manager->persist($company2);

        $manager->flush();
    }
}
