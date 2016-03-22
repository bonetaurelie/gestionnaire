<?php


namespace AB\UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\SecurityContext;


class SecurityController extends Controller

{

    public function loginAction(Request $request)

    {

        // Si le visiteur est déjà identifié, on le redirige vers l'accueil

        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

            return $this->redirectToRoute('ab_platform_paiement');

        }



        // Le service authentication_utils permet de récupérer le nom d'utilisateur

        // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide

        // (mauvais mot de passe par exemple)

        $authenticationUtils = $this->get('security.authentication_utils');


        return $this->render('ABUserBundle:Security:login.html.twig', array(

            'last_username' => $authenticationUtils->getLastUsername(),

            'error'         => $authenticationUtils->getLastAuthenticationError(),

        ));

    }

}