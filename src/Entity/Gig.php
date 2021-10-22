<?php

namespace App\Entity;

use DateTime;
use DateTimeImmutable;
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

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function getWebLink(): string
    {
        return $this->webLink;
    }

    public function getVenue(): string
    {
        return $this->venue;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
