<?php

namespace AB\PanierBundle\Controller;

use AB\PanierBundle\Entity\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PanierController extends Controller
{
    public function addAction($id,Request $request)
    {
        $panier= new Panier();
        $em= $this->getDoctrine()->getManager();
        $panier=$em->getRepository('ABPlatformBundle:Book')->find($id);

        $form=$this->get('form.factory')->create(new BookType(), $panier);
        if($form->handleRequest($request)->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($panier);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice','Le livre sélectionné a bien été enregistré dans le panier');
            return $this->render('ABPlatformBundle:Book:add.html.twig',array('id'=>$panier->getId()));
        }
        return $this->render('ABPlatformBundle:Book:add.html.twig',array('form'=>$form->createView()));
    }

}
