<?php

namespace AB\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public function accueilAction()
    {
            return $this->render('ABCoreBundle:Core:accueil.html.twig');
    }

}
