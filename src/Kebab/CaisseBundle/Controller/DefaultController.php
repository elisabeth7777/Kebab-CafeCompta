<?php

namespace Kebab\CaisseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KebabCaisseBundle:Default:index.html.twig');
    }
}
