<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Reco;
use App\Entity\User;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory as Faker;

class UserFixtures extends Fixture
{
    private $passHasher;
    private $userRepository;

    public function __construct(UserPasswordHasherInterface $passHasher, UserRepository $userRepository)
    {
        $this->passHasher = $passHasher;
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker::create('fr_FR');

        $userTest = new User();
        $userTest->setEmail('user@mail.com');
        $userTest->setPassword($this->passHasher->hashPassword($userTest,'password'));
        $userTest->setFirstname('User');
        $userTest->setLastname('Test');
        $userTest->setImage('img/user.png');
        $userTest->setPhone1($faker->phoneNumber());
        //role by default is ROLE_USER so is ok
        $manager->persist($userTest);

        $company1 = new Company();
        $company1->setName('Ets '.$faker->company());
        $company1->setUser($userTest);
        $manager->persist($company1);

        $company2 = new Company();
        $company2->setName('Ets '.$faker->company());
        $company2->setUser($userTest);
        $manager->persist($company2);

        $manager->flush();

        for ($n=0; $n<30; $n++){
            $user = new User();
            $user->setEmail($faker->email());
            $user->setPassword($this->passHasher->hashPassword($user, 'password'));
            $user->setFirstname($faker->firstName());
            $user->setLastname($faker->lastName());
            $user->setImage('img/user.png');
            $user->setPhone1($faker->phoneNumber());
            $manager->persist($user);

            $company = new Company();
            $company->setName('Ets '.$faker->company());
            $company->setUser($user);
            $manager->persist($company);
        }
        $manager->flush();

        for ($n=2; $n<32; $n++){
            $user1 = $this->userRepository->find(1);
            $user2 = $this->userRepository->find($n);

            $sentReco = new Reco();
            $sentReco->setCreatedAt(new DateTime());
            $sentReco->setSender($user2);
            $sentReco->setRecipient($user1);
            $sentReco->setContent('reco test: contactez client xxx');
            $manager->persist($sentReco);

            $receivedReco = new Reco();
            $receivedReco->setCreatedAt(new DateTime());
            $receivedReco->setSender($user1);
            $receivedReco->setRecipient($user2);
            $receivedReco->setContent('reco reçue: contactez client xxx');
            $manager->persist($receivedReco);
        }
        $manager->flush();
    }
}
