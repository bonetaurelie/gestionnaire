<?php

namespace AB\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BookController extends Controller
{
    public function accueilAction($page)
    {
        if($page<2){
            throw new NotFoundHttpException('Page"'.$page.'" inexistante.');
        }
            return $this->render('ABPlatformBundle:Book:accueil.html.twig');

    }

    public function addAction(){

    }

    public function deleteAction($id){

    }

    public function updateAction($id){

    }

    public function read(){

    }
}