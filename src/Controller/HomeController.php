<?php

namespace App\Controller;

use Doctrine\DBAL\Exception\TableNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private const GIG_LIMIT = 5;

    /**
     * @var ObjectRepository
     */
    private $gigRepository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->gigRepository = $em->getRepository('App\Entity\Gig');

    }

    #[Route('/')]
    public function index(): Response
    {
        try {
            $upcomingGigs = $this->gigRepository->findUpcomingGigs();
            $pastGigs = $this->gigRepository->findPastGigs(self::GIG_LIMIT);
        } catch (TableNotFoundException $e) {
            $upcomingGigs = [];
            $pastGigs = [];
        }

        return $this->render(
            'pages/home.html.twig',
            [
                'gigs' => $upcomingGigs,
                'pastGigs' => $pastGigs
            ]
        );
    }
}
