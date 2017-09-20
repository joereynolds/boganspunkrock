<?php

namespace AppBundle\Controller;

use AppBundle\Repository\Gig as GigRepository;
use AppBundle\Entity\Article;
use AppBundle\Entity\Gig;
use AppBundle\Entity\Review;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Mailgun\Mailgun;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $gigRepository = $this->getDoctrine()->getRepository(Gig::class);

        $gigs = $gigRepository->findUpcomingGigs();
        $pastGigs = $gigRepository->findPastGigs();

        $reviews = $this->findAllEntities(Review::class);

        return $this->render('default/index.html.twig', [
            'page' => 'home',
            'gigs' => $gigs,
            'pastGigs' => $pastGigs,
            'review' => $reviews[array_rand($reviews)]
        ]);
    }

    /**
     * @Route("/contact")
     */
    public function contactAction()
    {
        $request = Request::createFromGlobals();

        if ($request->request->get('email')) {

            $apiKey = $this->getParameter('mailgun_key');

            $mailGun = MailGun::create($apiKey);
            $mailGun->messages()->send('bogans.uk', [
                'from' => 'contactform@bogans.uk',
                'to' => 'boganspunkrock@gmail.com',
                'subject' => "You've got mail from the site!",
                'text' => $request->request->get('text')
            ]);
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
