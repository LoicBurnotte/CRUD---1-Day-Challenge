<?php

namespace CollectionBundle\Controller;

use CollectionBundle\Entity\Category;
use CollectionBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    public function addAction(Request $request)
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('collection_category_read');
        }

        $this->get('session')->getFlashBag()->add('success', 'add category');

        return $this->render('@Collection/category/add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Request $request, $categoryID)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('CollectionBundle:Category')->find($categoryID);

        if($category === null){
            throw $this->createNotFoundException('Category not found!');
        }

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('collection_category_read');
        }

        $this->get('session')->getFlashBag()->add('success', 'edit category');

        return $this->render('@Collection/category/edit.html.twig', array(
            'form' => $form->createView(),
            'category' => $category
        ));
    }

    public function readAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('CollectionBundle:Category')->findAll();

        $this->get('session')->getFlashBag()->add('success', 'read categories');

        return $this->render('@Collection/category/read.html.twig', array(
            'categories' => $categories
        ));
    }

    public function removeAction($categoryID)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('CollectionBundle:Category')->find($categoryID);

        $em->remove($category);

        if($category === null)
        {
            throw $this->createNotFoundException('Category not found!');
        }

        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'remove category');

        return $this->redirectToRoute('collection_category_read');
    }
}
