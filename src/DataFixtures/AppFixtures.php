<?php

namespace App\DataFixtures;

use App\Entity\Building;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 11 floor with lighters
        for ($i = 0; $i < 12; $i++) {
            $req = new Building();
            $req->setLights(mt_rand(0, 1));
            $req->setFloor(mt_rand(-1, 11));
            $manager->persist($req);
        }

        $manager->flush();
    }
}
