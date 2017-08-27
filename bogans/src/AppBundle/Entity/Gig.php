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
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $location;

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

    public function getTitle()
    {
        return $this->title;
    }
}
