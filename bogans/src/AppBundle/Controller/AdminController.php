<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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

        $form = $this->generateGigForm($manager, null);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->persistSubmittedGig($manager, $form);
        }

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

        $form = $this->generateGigForm($manager, $id);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->persistSubmittedGig($manager, $form);
        }

        return $this->render('default/index.html.twig', [
            'page' => 'admin-gigs',
            'form' => $form->createView(),
        ]);
    }

    private function generateGigForm($manager, $id)
    {
        $gig = new Gig();

        //If there's an id, load our gig object instead
        //of an empty one
        if ($id) {
            $gig = $manager->getRepository(Gig::class)->find($id);
        }

        $form = $this->createFormBuilder($gig)
            ->add('date', DateType::class)
            ->add('location', TextType::class)
            ->add('artist', TextType::class)
            ->add('prefix', TextType::class)
            ->add('url', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();

        return $form;
    }

    private function persistSubmittedGig($manager, $form)
    {
        $gig = $form->getData();
        $manager->persist($gig);
        $manager->flush();
    }

    private function findAllEntities($entity)
    {
        $repository = $this->getDoctrine()->getRepository($entity);
        return $repository->findAll();
    }
}
