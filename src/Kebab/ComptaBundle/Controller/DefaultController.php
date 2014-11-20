<?php

namespace Kebab\ComptaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KebabComptaBundle:Default:index.html.twig');
    }
}
