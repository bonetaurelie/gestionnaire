<?php

namespace AB\PlatformBundle\Controller;

use AB\PlatformBundle\Entity\Book;
use AB\PlatformBundle\Entity\BookPanier;
use AB\PlatformBundle\Entity\Client;
use AB\PlatformBundle\Entity\Panier;
use AB\PlatformBundle\Form\BookPanierType;
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

    public  function ajoutAction(Request $request, $id,$date)
    {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('ABPlatformBundle:Book')->find($id);
        $panier = new Panier();
        $bookpanier = new BookPanier();
        $form = $this->createForm(new BookPanierType(),$bookpanier);
        $form->handleRequest($request);
        if($form->isValid()){
            $now = new \DateTime(date('Y-m-d'));
            $panier->setDate($now);
            $em->persist($panier);
            $book->setQuantite($book->getQuantite()- $bookpanier->getQuantite());
            $em->persist($book);
            $bookpanier->setBook($book);
            $bookpanier->setPanier($panier);
            $em->persist($bookpanier);
            $em->flush();
            if ($form->get('menu')->isClicked()) {
                return $this->redirect($this->generateUrl("ab_platform_read"));
            }
            if ($form->get('panier')->isClicked()) {
                return $this->redirect($this->generateUrl("ab_platform_panier",array('id'=>$id,'date'=>$date)));
            }
        }
        return $this->render('ABPlatformBundle:Book:choix.html.twig',array('book'=>$book,'form'=>$form->createView()));
    }

    public function updatePanierAction($id,$date,Request $request){

        $panier = $this->getDoctrine()->getManager()->getRepository('ABPlatformBundle:Panier')->findOneById($date);

        /*$form=$this->get('form.factory')->create(new BookType(), $panier);
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
        }*/
        return $this->render('ABPlatformBundle:Book:panier.html.twig',array('panier'=>$panier/*'form'=>$form->createView()*/));
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