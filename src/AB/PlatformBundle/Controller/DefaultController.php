<?php

namespace AB\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ABPlatformBundle:Default:index.html.twig');
    }
}
