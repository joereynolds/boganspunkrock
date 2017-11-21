<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Form\GigType;

use AppBundle\Entity\Gig;
use AppBundle\Entity\Article;

class AdminController extends Controller
{

    /**
     * @Route("/admin")
     */
    public function adminAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'page' => 'admin',
            'gigs' => $this->findAllEntities(Gig::class),
            'articles' => $this->findAllEntities(Article::class)
        ]);
    }

    /**
     * @Route("/admin/gigs/{id}")
     */
    public function adminGigAction(Request $request, $id = null)
    {
        $manager = $this->getDoctrine()->getManager();
        $gig = new Gig();

        if ($id) {
            $gig = $manager->getRepository(Gig::class)->find($id);
        }

        $form = $this->createForm(GigType::class, $gig);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gig = $form->getData();
            $manager->persist($gig);
            $manager->flush();
        }

        return $this->render('default/index.html.twig', [
            'page' => 'admin-gigs',
            'form' => $form->createView(),
        ]);
    }

    private function findAllEntities($entity)
    {
        $repository = $this->getDoctrine()->getRepository($entity);
        return $repository->findAll();
    }
}
