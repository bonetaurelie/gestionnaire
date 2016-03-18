<?php

namespace AB\PanierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PanierController extends Controller
{
    public function addAction()
    {
        return $this->render('ABPanierBundle:Default:index.html.twig');
    }
}
