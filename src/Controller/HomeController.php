<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @var ObjectRepository
     */
    private $gigRepository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->gigRepository = $em->getRepository('App\Entity\Gig');
    }

    public function index(): Response
    {
        return $this->render(
            'pages/home.html.twig',
            [
                'gigs' => $this->gigRepository->findAll()
            ]
        );
    }
}
