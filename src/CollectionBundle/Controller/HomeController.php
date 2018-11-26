<?php

namespace CollectionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function homeAction()
    {
        return $this->render('@Collection/home/home.html.twig');
    }
}
