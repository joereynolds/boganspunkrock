<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Gig;
use AppBundle\Entity\Review;
use AppBundle\Entity\Article;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->fakeGigs($manager);
    }

    private function fakeGigs(ObjectManager $manager)
    {
        $now = new DateTime();
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $gig= new Gig();
            $gig->setPrefix('with ' . $i);
            $gig->setUrl('http://google.com');
            $gig->setLocation('England');
            $gig->setArtist('Metallica');
            $gig->setDate($now);
            $manager->persist($gig);
        }

        $manager->flush();
    }
}
