<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Gig;
use AppBundle\Entity\Review;
use AppBundle\Entity\Article;

class AdminController extends Controller
{
    /**
     * @Route("/admin")
     */
    public function adminAction(Request $request)
    {
        $gig = new Gig();

        $form = $this->createFormBuilder($gig)
            ->add('date', DateType::class)
            ->add('url', TextType::class)
            ->add('location', TextType::class)
            ->add('artist', TextType::class)
            ->add('prefix', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newGig = $form->getData();

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($newGig);
            $manager->flush();
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

        $form = $this->createFormBuilder($gig)
            ->add('date', DateType::class)
            ->add('location', TextType::class)
            ->add('artist', TextType::class)
            ->add('prefix', TextType::class)
            ->add('url', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();

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
