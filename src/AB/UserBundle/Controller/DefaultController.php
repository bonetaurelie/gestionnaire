<?php

namespace AB\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ABUserBundle:Default:index.html.twig');
    }
}
