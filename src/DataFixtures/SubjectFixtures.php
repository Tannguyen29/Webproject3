<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $subject1 = new Subject;
        $subject1->setsubjectcode("M11")
                 ->setsubjectname("Math");
        $manager->persist($subject1);

        $subject2 = new Subject;
        $subject2->setsubjectcode("VN11")
                 ->setsubjectname("VietNamese");
        $manager->persist($subject2);    

        $subject3 = new Subject;
        $subject3->setsubjectcode("Phy11")
                 ->setsubjectname("Physics");
        $manager->persist($subject3);
        
        $subject4 = new Subject;
        $subject4->setsubjectcode("Chem11")
                 ->setsubjectname("Chemistry");
        $manager->persist($subject4);

        $subject5 = new Subject;
        $subject5->setsubjectcode("Bio11")
                 ->setsubjectname("Biology");
        $manager->persist($subject5);

        $manager->flush();
    }
}
