<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Gig")
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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $prefix = null;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $artist = null;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $location;

    /**
     * URL of the artist that is also playing
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url = null;

    /**
     * @ORM\Column(type="date", length=100)
     */
    private $date;

    public function getId()
    {
        return $this->id;
    }

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

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }
}
