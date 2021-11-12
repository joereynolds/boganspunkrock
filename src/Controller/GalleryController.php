<?php

namespace App\Controller;

use Aws\S3\S3Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GalleryController extends AbstractController
{
    const BUCKET = 'bogans-storage-bucket';

    const IMAGE_BASE_URL = 'https://d3fd096igel8cg.cloudfront.net/';

    /**
     * @var S3Client
     */
    private $client;

    public function __construct(S3Client $client)
    {
        $this->client = $client;
    }

    #[Route('/gallery', name: 'gallery_index')]
    public function index(): Response
    {
        $s3Objects = $this->client->listObjectsV2([
            'Bucket' => self::BUCKET,
            'Prefix' => 'images/',
            'MaxKeys' => 5,
            'Delimiter' => '/'
        ])->get('CommonPrefixes');

        return $this->render(
            'pages/gallery-index.html.twig',
            [
                's3Url' => self::IMAGE_BASE_URL,
                'galleries' => $s3Objects
            ]
        );
    }

    #[Route('/gallery/show', name: 'gallery')]
    public function show(Request $request): Response
    {
        $name = $request->get('name');

        $images = $this->client->listObjectsV2([
            'Bucket' => self::BUCKET,
            'Prefix' => $name,
            'MaxKeys' => 15,
        ])->get('Contents');

        return $this->render(
            'pages/gallery.html.twig',
            [
                'imageBaseUrl' => self::IMAGE_BASE_URL,
                'title' => $name,
                'images' => $images
            ]
        );
    }
}
