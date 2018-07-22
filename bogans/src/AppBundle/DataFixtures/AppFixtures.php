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
        $this->fakeReviews($manager);
        $this->fakeNews($manager);
    }

    private function fakeReviews(ObjectManager $manager)
    {
        $now = new DateTime();

        for ($i = 0; $i < 20; $i++) {
            $review = new Review();
            $review->setSource('with ' . $i);
            $review->setUrl('http://google.com');
            $review->setFullText('They were terrible');
            $review->setTitle('Never Again');
            $manager->persist($review);
        }

        $manager->flush();
    }

    private function fakeNews(ObjectManager $manager)
    {
        $now = new DateTime();

        for ($i = 0; $i < 20; $i++) {
            $article = new Article();
            $article->setTitle("Never Again $i");
            $article->setImage('not-found.jpg');
            $article->setText('This is just some text for our fixtures');
            $article->setDate($now);
            $manager->persist($article);
        }

        $manager->flush();
    }

    private function fakeGigs(ObjectManager $manager)
    {
        $now = new DateTime();

        // Gigs in the future
        for ($i = 0; $i < 20; $i++) {
            $gig = new Gig();
            $gig->setPrefix('with ' . $i);
            $gig->setUrl('http://google.com');
            $gig->setLocation('England');
            $gig->setArtist('Metallica');
            $gig->setDate($now);
            $manager->persist($gig);
        }

        $past = DateTime::createFromFormat('Y-m-d', '2008-02-05');

        // Gigs in the past
        for ($i = 0; $i < 4; $i++) {
            $gig = new Gig();
            $gig->setPrefix('with ' . $i);
            $gig->setUrl('http://google.com');
            $gig->setLocation('England');
            $gig->setArtist('Metallica');
            $gig->setDate($past);
            $manager->persist($gig);
        }
        $manager->flush();
    }
}
