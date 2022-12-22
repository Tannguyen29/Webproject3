<?php

namespace App\DataFixtures;
use App\Entity\Classroom;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClassroomFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $class1 = new Classroom;
        $class1->setclassname("11A2");
        $manager->persist($class1);

        $class2 = new Classroom;
        $class2->setclassname("11A3");
        $manager->persist($class2);

        $class3 = new Classroom;
        $class3->setclassname("11A4");
        $manager->persist($class3);

        $class4 = new Classroom;
        $class4->setclassname("11A5");
        $manager->persist($class4);

        $class5 = new Classroom;
        $class5->setclassname("11A6");
        $manager->persist($class5);

        $manager->flush();
    }
}
