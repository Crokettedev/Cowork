<?php

namespace App\Controller;


use App\Entity\PlacePublic;
use App\Entity\SpacePublic;
use App\Form\PlaceType;
use App\Repository\CartRepository;
use App\Repository\PlacePublicRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlacePublicController extends AbstractController
{
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * @var CartRepository
     */

    private $repository;
    private $public;

    public function __construct(PlacePublicRepository $public)
    {
        $this->public = $public;
    }

    /**
     * @Route("/place/public/{id}", name="place_public")
     */
    public function index(SpacePublic $spacePublic)
    {
        $repo = $this->getDoctrine()->getRepository(SpacePublic::class);
        $place = $repo->find($spacePublic);


        return $this->render('place_public/index.html.twig', [
            'places' => $place
        ]);
    }

    /**
     * @Route("/add/place/{slug}-{id}", name="add_place", requirements={"slug": "[a-z0-9\-]*"})
     * @param SpacePublic $spacePublic
     * @return Response
     */
    public function addPlace(SpacePublic $spacePublic, Request $request, string $slug): Response
    {
        if ($spacePublic->getSlug() !== $slug)
        {
            return $this->redirectToRoute('add_place', [
                'id' => $spacePublic->getId(),
                'slug' => $spacePublic->getSlug()
            ], 301);
        }
        $repo = $this->getDoctrine()->getRepository(SpacePublic::class);
        $place = $repo->find($spacePublic);

        $public = new PlacePublic();
        $form = $this->createForm(PlaceType::class, $public);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($public);
            $entityManager->flush();

            $this->addFlash('success','La place à bien été enregistré');

        }


        return $this->render('place_public/new.html.twig', [
            'places' => $place,
            'placeForm' => $form->createView(),
        ]);
    }
}
