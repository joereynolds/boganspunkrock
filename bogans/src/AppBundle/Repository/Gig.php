<?php

namespace AppBundle\Repository;

use DateTime;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;

class Gig extends EntityRepository
{
    public function findPastGigs()
    {
        $today = new DateTime();

        $criteria = new Criteria();
        $criteria
            ->where($criteria->expr()->lt('date', $today))
            ->orderBy(['date' => 'DESC']);

        return $this->matching($criteria);
    }

    public function findUpcomingGigs()
    {
        $yesterday = (new DateTime())->modify('-1 day');

        $criteria = new Criteria();
        $criteria
            ->where($criteria->expr()->gt('date', $yesterday))
            ->orderBy(['date' => 'ASC']);

        return $this->matching($criteria);
    }
}
