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

class AdminController extends Controller
{

    /**
     * @Route("/admin")
     */
    public function adminAction(Request $request)
    {
        $gig = new Gig();
        $manager = $this->getDoctrine()->getManager();

        $form = $this->createForm(GigType::class, $gig);
        $form->handleRequest($request);
        $this->submitForm($manager, $form);

        return $this->render('default/index.html.twig', [
            'page' => 'admin',
            'form' => $form->createView(),
            'gigs' => $this->findAllEntities(Gig::class),
        ]);
    }

    /**
     * @Route("/admin/gigs/{id}")
     */
    public function adminGigUpdateAction(Request $request, $id)
    {
        $manager = $this->getDoctrine()->getManager();
        $gig = $manager->getRepository(Gig::class)->find($id);

        $form = $this->createForm(GigType::class, $gig);
        $form->handleRequest($request);
        $this->submitForm($manager, $form);

        return $this->render('default/index.html.twig', [
            'page' => 'admin-gigs',
            'form' => $form->createView(),
        ]);
    }

    private function submitForm($manager, $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $gig = $form->getData();
            $manager->persist($gig);
            $manager->flush();
        }
    }

    private function findAllEntities($entity)
    {
        $repository = $this->getDoctrine()->getRepository($entity);
        return $repository->findAll();
    }
}
