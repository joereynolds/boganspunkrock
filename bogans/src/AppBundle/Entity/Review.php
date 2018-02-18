<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="review")
 */
class Review
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * This is the main headline
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * The name of the reviewer
     * @ORM\Column(type="string", length=100)
     */
    private $source;

    /**
     * The url of the review
     * @ORM\Column(type="string")
     */
    private $url;

    /**
     * The entire review text
     * @ORM\Column(type="text")
     */
    private $fullText;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function getFullText()
    {
        return $this->fullText;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setSource($source)
    {
        $this->source = $source;
    }

    public function setFullText($text)
    {
        $this->fullText = $text;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }
}

