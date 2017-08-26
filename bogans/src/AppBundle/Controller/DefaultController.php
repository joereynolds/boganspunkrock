<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig', [
            'page' => 'home'
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
        return $this->render('default/index.html.twig', [
            'page' => 'news'
        ]);
    }




}
