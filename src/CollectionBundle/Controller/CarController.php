<?php

namespace CollectionBundle\Controller;

use CollectionBundle\Entity\Car;
use CollectionBundle\Form\CarType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CarController extends Controller
{
    public function addAction(Request $request)
    {
        $car = new Car();

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

            return $this->redirectToRoute('collection_car_read');
        }

        $this->get('session')->getFlashBag()->add('success', 'add car');

        return $this->render('@Collection/car/add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Request $request, $carID)
    {
        $em = $this->getDoctrine()->getManager();
        $car = $em->getRepository('CollectionBundle:Car')->find($carID);

        if($car === null){
            throw $this->createNotFoundException('Car not found!');
        }

        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($car);
            $em->flush();
            return $this->redirectToRoute('collection_car_read');
        }

        $this->get('session')->getFlashBag()->add('success', 'edit car');

        return $this->render('@Collection/car/edit.html.twig', array(
            'form' => $form->createView(),
            'car' => $car
        ));
    }

    public function readAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cars = $em->getRepository('CollectionBundle:Car')->findAll();

        $this->get('session')->getFlashBag()->add('success', 'read car(s)');

        return $this->render('@Collection/car/read.html.twig', array(
            'cars' => $cars
        ));
    }

    public function removeAction($carID)
    {
        $em = $this->getDoctrine()->getManager();
        $car = $em->getRepository('CollectionBundle:Car')->find($carID);

        $em->remove($car);

        if($car === null)
        {
            throw $this->createNotFoundException('Car not found!');
        }

        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'remove car');

        return $this->redirectToRoute('collection_car_read');
    }

}
