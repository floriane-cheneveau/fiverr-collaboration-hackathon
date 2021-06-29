<?php

namespace App\DataFixtures;

use App\Entity\Freelancer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FreelancerFixtures extends Fixture
{
     const FREELANCERS = [
        [
            'Remy',
            'Dev front'    
        ], [
            'jacky',
            'Dev back end'
        ], [
            'etienne',
            'design'
        ]
    ];  

    public function load(ObjectManager $manager)
    {
         foreach (self::FREELANCERS as $freelancerData) {
            $freelancer = new Freelancer();
              $freelancer->setUsername($freelancerData[0]);
            $freelancer->setCategorie($freelancerData[1]);
            $freelancer->setPassword($this->passwordEncoder->encodePassword(
                $freelancer,
                'Freelancerpassword'
            ));
            $manager->persist($freelancer);
        }
        $manager->flush();
    }
}
