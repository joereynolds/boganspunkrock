<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="gig")
 */
class Gig
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * i.e. "Supporting" or "With" or "Playing with"
     * @ORM\Column(type="string", length=100)
     */
    private $prefix;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $artist;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $location;

    /**
     * URL of the artist that is also playing
     * @ORM\Column(type="string")
     */
    private $url;
    /**
     * @ORM\Column(type="date", length=100)
     */
    private $date;

    public function getDate()
    {
        return $this->date;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getArtist()
    {
        return $this->artist;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function getUrl()
    {
        return $this->url;
    }
}
