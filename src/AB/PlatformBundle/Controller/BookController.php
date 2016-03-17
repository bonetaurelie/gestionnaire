<?php

namespace AB\PlatformBundle\Controller;

use AB\PlatformBundle\Entity\Book;
use AB\PlatformBundle\Form\BookType;
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

    public function deleteAction($id){
    }

    public function updateAction($id){

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
}