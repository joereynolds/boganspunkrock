<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="gigs")
 */
class Gig
{
    /** 
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $venue;

    /**
     * @ORM\Column(type="string")
     */
    private $prefix;

    /**
     * @ORM\Column(type="string")
     */
    private $webLink;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;
}
