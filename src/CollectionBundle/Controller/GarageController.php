<?php

namespace CollectionBundle\Controller;

use CollectionBundle\Entity\Garage;
use CollectionBundle\Form\GarageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GarageController extends Controller
{
    public function addAction(Request $request)
    {
        $garage = new Garage();

        $form = $this->createForm(GarageType::class, $garage);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($garage);
            $em->flush();

            return $this->redirectToRoute('collection_home');
        }

        $this->get('session')->getFlashBag()->add('success', 'add garage');

        return $this->render('@Collection/garage/add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Request $request, $garageID)
    {
        $em = $this->getDoctrine()->getManager();
        $garage = $em->getRepository('CollectionBundle:Garage')->find($garageID);

        if($garage === null){
            throw $this->createNotFoundException('Garage not found!');
        }

        $form = $this->createForm(GarageType::class, $garage);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($garage);
            $em->flush();
            return $this->redirectToRoute('collection_home');
        }

        $this->get('session')->getFlashBag()->add('success', 'edit garage');

        return $this->render('@Collection/garage/edit.html.twig', array(
            'form' => $form->createView(),
            'garage' => $garage
        ));
    }

    public function readAction()
    {
        $em = $this->getDoctrine()->getManager();
        $garages = $em->getRepository('CollectionBundle:Garage')->findAll();

        $this->get('session')->getFlashBag()->add('success', 'read garage(s)');

        return $this->render('@Collection/home/home.html.twig', array(
            'garages' => $garages
        ));
    }

    public function removeAction($garageID)
    {
        $em = $this->getDoctrine()->getManager();
        $garage = $em->getRepository('CollectionBundle:Garage')->find($garageID);

        $em->remove($garage);

        if($garage === null)
        {
            throw $this->createNotFoundException('Garage not found!');
        }

        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'remove garage');

        return $this->redirectToRoute('collection_home');
    }
}
