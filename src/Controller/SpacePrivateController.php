<?php

namespace App\Controller;

use App\Entity\SpacePrivate;
use App\Form\SpacePrivateType;
use App\Repository\SpacePrivateRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpacePrivateController extends AbstractController
{
    private $spacePrivate;

    public function __construct(SpacePrivateRepository $spacePrivateRepository)
    {
        $this->spacePrivate = $spacePrivateRepository;
    }

    /**
     * @Route("/Add/Space/Private", name="space_private")
     */
    public function addSpace(ObjectManager $manager, Request $request): Response
    {
        $private = new SpacePrivate();
        $form = $this->createForm(SpacePrivateType::class, $private);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($private);
            $entityManager->flush();

            $this->addFlash('success','Votre message à bien été envoyer, merci à vous.');

        }

        return $this->render('space_private/index.html.twig', [
            'spacePrivateForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Salons/Prive", name="viewspaceprivate")
     */
    public function viewSpacePrivate()
    {
        $space = $this->spacePrivate->findAll();
        return $this->render('space_private/index.html.twig', [
            'space' => $space
        ]);
    }
}
