<?php

namespace App\Controller;

use Aws\S3\S3Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GalleryController extends AbstractController
{
    public function __construct(S3Client $client)
    {
        $this->client = $client;
    }

    #[Route('/gallery', name: 'gallery')]
    public function index(): Response
    {
        return $this->render('pages/gallery.html.twig', []);
    }
}
