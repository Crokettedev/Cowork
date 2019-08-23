<?php

namespace App\Controller;

use App\Entity\SpacePublic;
use App\Form\SpacePublicType;
use App\Repository\SpacePublicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpacePublicController extends AbstractController
{
    private $public;

    public function __construct(SpacePublicRepository $public)
    {
        $this->public = $public;
    }

    /**
     * @Route("/space/public", name="space_public")
     */
    public function index(Request $request): Response
    {
        $public = $this->public->findAll();
        return $this->render('space_public/index.html.twig', [
            'SpacePublic' => $public,
        ]);
    }

    /**
     * @Route("add/view/place", name="add_view_place")
     */
    public function viewSpace(): Response
    {
        $public = $this->public->findAll();
        return $this->render('place_public/view.html.twig', [
            'public' => $public,
        ]);
    }

    /**
     * @Route("/add/space/public", name="add_table")
     */
    public function addTable(Request $request): Response
    {
        $public = new SpacePublic();
        $form = $this->createForm(SpacePublicType::class, $public);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($public);
            $entityManager->flush();

            $this->addFlash('success','Votre message à bien été envoyer, merci à vous.');

        }

        return $this->render('space_public/new.html.twig', [
            'spaceForm' => $form->createView(),
        ]);

    }

}
