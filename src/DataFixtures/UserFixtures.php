<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->hasher = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User;
        $user1->setEmail("admin@gmail.com")
              ->setRoles(["ROLE_ADMIN"])
              ->setPassword($this->hasher->hashPassword($user1,"123456"))
              ->setName("admin")
              ->setDOB(\DateTime::createFromFormat('Y/m/d','2003/05/25'))
              ->setPhonenumber("091234567")
              ->setAddress("Hanoi")
              ->setImage("anh.jpg");
        $manager->persist($user1);

        //tạo tài khoản test cho role "USER"
        $user2 = new User;
        $user2->setEmail("user@gmail.com")
              ->setRoles(["ROLE_USER"])
              ->setPassword($this->hasher->hashPassword($user2, "123456"))
              ->setName("Hung")
              ->setDOB(\DateTime::createFromFormat('Y/m/d','2003/05/25'))
              ->setPhonenumber("091234567")
              ->setAddress("Hanoi")
              ->setImage("anh.jpg");
        $manager->persist($user2);

        $manager->flush();
    }
}
