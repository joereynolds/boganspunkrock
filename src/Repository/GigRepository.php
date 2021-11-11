<?php

namespace App\Repository;

use DateTimeImmutable;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\LazyCriteriaCollection;

class GigRepository extends EntityRepository
{
    public function findPastGigs(?int $limit = null)
    {
        $today = new DateTimeImmutable();

        $criteria = new Criteria();
        $criteria
            ->where($criteria->expr()->lt('date', $today))
            ->orderBy(['date' => 'DESC']);

        $matches = $this->matching($criteria);

        if ($limit) {
            $matches = $matches->slice(0, $limit);
        }

        return $matches;
    }

    public function findUpcomingGigs(): LazyCriteriaCollection
    {
        $yesterday = (new DateTimeImmutable())->modify('-1 day');

        $criteria = new Criteria();
        $criteria
            ->where($criteria->expr()->gt('date', $yesterday))
            ->orderBy(['date' => 'ASC']);

        return $this->matching($criteria);
    }
}
