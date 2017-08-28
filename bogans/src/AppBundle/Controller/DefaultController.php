<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Gig;
use AppBundle\Entity\Review;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $gigs = $this->findAllEntities(Gig::class);

        return $this->render('default/index.html.twig', [
            'page' => 'home',
            'gigs' => $gigs
        ]);
    }

    /**
     * @Route("/contact")
     */
    public function contactAction()
    {
        $request = Request::createFromGlobals();

        if ($request->request->get('email')) {
            mail(
                'boganspunkrock@gmail.com',
                "You've got mail from the site!",
                $request->request->get('text')
            );
        }

        return $this->render('default/index.html.twig', [
            'page' => 'contact'
        ]);
    }

    /**
     * @Route("/news")
     */
    public function newsAction()
    {
        $articles = $this->findAllEntities(Article::class);

        return $this->render('default/index.html.twig', [
            'page' => 'news',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/reviews")
     */
    public function reviewAction()
    {
        $reviews = $this->findAllEntities(Review::class);

        return $this->render('default/index.html.twig', [
            'page' => 'reviews',
            'reviews' => $reviews
        ]);
    }

    private function findAllEntities($entity)
    {
        $repository = $this->getDoctrine()->getRepository($entity);
        return $repository->findAll();
    }
}
