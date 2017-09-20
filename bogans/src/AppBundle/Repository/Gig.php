<?php

namespace AppBundle\Repository;

use DateTime;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Gig as GigEntity;

class Gig extends EntityRepository
{
    public function findPastGigs()
    {
        $today = new DateTime();

        $criteria = new Criteria();
        $criteria->where($criteria->expr()->lt('date', $today));

        return $this->matching($criteria);
    }

    public function findUpcomingGigs()
    {
        $yesterday = (new DateTime())->modify('-1 day');

        $criteria = new Criteria();
        $criteria->where($criteria->expr()->gt('date', $yesterday));

        return $this->matching($criteria);
    }
}
