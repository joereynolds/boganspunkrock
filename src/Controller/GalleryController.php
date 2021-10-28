<?php

namespace App\Controller;

use Aws\S3\S3Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GalleryController extends AbstractController
{
    const BUCKET = 'bogans-storage-bucket';

    const S3_BASE_URL = self::BUCKET . '.s3.eu-west-2.amazonaws.com/';

    /**
     * @var S3Client
     */
    private $client;

    public function __construct(S3Client $client)
    {
        $this->client = $client;
    }

    #[Route('/gallery', name: 'gallery')]
    public function index(): Response
    {
        $candidImages = $this->client->listObjectsV2([
            'Bucket' => self::BUCKET,
            'Prefix' => 'images/doc',
            'MaxKeys' => 5
        ]);

        // TODO - create a Gallery object (name, and images)
        $candidGallery = [
            'name' => 'Rehearsing',
            'images' => $candidImages->get('Contents')
        ];

        return $this->render(
            'pages/gallery.html.twig',
            [
                's3Url' => self::S3_BASE_URL,
                'galleries' => [$candidGallery]
            ]
        );
    }
}
