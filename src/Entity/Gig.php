<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="gigs")
 */
class Gig
{
    private $eventName;
    private $location;
    private $date;
}
