<?php

namespace AB\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ABCoreBundle:Default:index.html.twig');
    }
}
