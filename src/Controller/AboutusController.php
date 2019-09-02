<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutusController extends AbstractController
{
    /**
     * Afficher la page a propos
     * @Route("/A-propos", name="aboutus")
     */
    public function aboutus()
    {
        return $this->render('aboutus/index.html.twig', [
            'controller_name' => 'AboutusController',
        ]);
    }

    /**
     * Afficher la page a propos
     * @Route("/Mentions-légales", name="legalnotice")
     */
    public function legalnotice()
    {
        return $this->render('aboutus/legalnotice.html.twig', [
            'controller_name' => 'AboutusController',
        ]);
    }

    /**
     * Afficher la page a propos
     * @Route("/Conditions-generales-vente", name="legalnoticevente")
     */
    public function legalnoticevente()
    {
        return $this->render('aboutus/legalnoticevente.html.twig', [
            'controller_name' => 'AboutusController',
        ]);
    }

    /**
     * Afficher la page a propos
     * @Route("/Politque-de-cookie", name="legalnoticecookie")
     */
    public function legalnoticecookie()
    {
        return $this->render('aboutus/legalnoticecookie.html.twig', [
            'controller_name' => 'AboutusController',
        ]);
    }
}
