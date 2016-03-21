<?php

namespace AB\PlatformBundle\Controller;

use AB\PlatformBundle\Entity\Book;
use AB\PlatformBundle\Entity\Client;
use AB\PlatformBundle\Entity\Panier;
use AB\PlatformBundle\Form\BookType;
use AB\PlatformBundle\Form\ClientType;
use AB\PlatformBundle\Form\PanierType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{
    public function addAction(Request $request){
        $book= new Book();
        $form= $this->get('form.factory')->create(new BookType(),$book);
        if($form->handleRequest($request)->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice','Le livre a bien été enregistré');
            return $this->redirectToRoute('ab_platform_read',array('id'=>$book->getId()));
        }
        return $this->render('ABPlatformBundle:Book:add.html.twig',array('form'=>$form->createView()));

    }

    public function deleteAction($id, Request $request){

        $em = $this->getDoctrine()->getManager();
        $listBook= $em->getRepository('ABPlatformBundle:Book')->find($id);
        $em->remove($listBook);
        $em->flush();
        if($request->isMethod('GET')) {
            $request->getSession()->getFlashBag()->add('notice', 'le livre sélectionné a bien été supprimé');
            return $this->redirectToRoute('ab_platform_read');
        }

        return $this->render('ABPlatformBundle:Book:read.html.twig',array('listBook'=>$listBook));
    }

    public function updateAction($id, Request $request){
        $listBook= $this->getDoctrine()->getManager()->getRepository('ABPlatformBundle:Book')->find($id);

        $form=$this->get('form.factory')->create(new BookType(), $listBook);
        if($form->handleRequest($request)->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($listBook);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice','Le livre sélectionné a bien été modifié');
            return $this->redirectToRoute('ab_platform_read',array('id'=>$listBook->getId()));
        }
        return $this->render('ABPlatformBundle:Book:update.html.twig',array('form'=>$form->createView()));
    }

    public function readAction(){
        $listBook= $this->getDoctrine()->getManager()->getRepository('ABPlatformBundle:Book')->findAll();
        return $this->render('ABPlatformBundle:Book:read.html.twig',array('listBook'=>$listBook));
    }

    public function menuAction($limit= 4){
        $listBook= $this->getDoctrine()->getManager()->getRepository('ABPlatformBundle:Book')->findBy(
            array(),
            array('date'=>'desc'),
            $limit,
            0);
        return $this->render('ABPlatformBundle:Book:menu.html.twig',array('listBook'=>$listBook));
    }

    public  function ajoutAction($id)
    {
        $book = $this->getDoctrine()->getManager()->getRepository('ABPlatformBundle:Book')->find($id);
            return $this->render('ABPlatformBundle:Book:choix.html.twig',array('book'=>$book));
    }

    public function updatePanierAction($id,$titre,$auteur,$prix,$quantite, Request $request){
        $panier = $this->getDoctrine()->getManager()->getRepository('ABPlatformBundle:Book')->find($id);

        $form=$this->get('form.factory')->create(new BookType(), $panier);
        $panier= new Panier();
        $panier->setTitre($titre);
        $panier->setAuteur($auteur);
        $panier->setPrix($prix);
        $panier->setQuantite($quantite);
        if($form->handleRequest($request)->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($panier);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice','Le livre sélectionné a bien été enregistré dans votre panier');
            return $this->redirectToRoute('ab_platform_validation',array('id'=>$id,'titre'=>$panier->getTitre(),'auteur'=>$panier->getAuteur(),'prix'=>$panier->getPrix(), 'quantite'=>$quantite));
        }
        return $this->render('ABPlatformBundle:Book:panier.html.twig',array('form'=>$form->createView()));
    }

    public function validationAction($id, $limit=1, $offet=0, $titre){
        $listBook= $this->getDoctrine()->getManager()->getRepository('ABPlatformBundle:Panier')->findBy(
            array('titre'=>$titre),
            array('date'=>'DESC'),
            $limit,
            $offet
        );
        return $this->render('ABPlatformBundle:Book:validation.html.twig',array('listBook'=>$listBook));
    }

    public function compteAction(){
        return $this->render('ABPlatformBundle:Book:compte.html.twig');
    }

    public function paiementAction(){
        /*$listBook= $this->getDoctrine()->getManager()->getRepository('ABPlatformBundle:Panier')->findBy(
            array('titre'=>$titre),
            array('date'=>'DESC'),
            $limit,
            $offet
        );*/
        return $this->render('ABPlatformBundle:Book:paiement.html.twig');

    }

}