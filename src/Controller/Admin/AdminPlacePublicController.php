<?php

namespace App\Controller\Admin;

use App\Entity\PlacePublic;
use App\Entity\SpacePublic;
use App\Form\AdminPlacePublicType;
use App\Form\AdminPlacePublicTypePlaceType;
use App\Repository\PlacePublicRepository;
use App\Repository\SpacePublicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminPlacePublicController extends AbstractController

{


    /**
     * @Route("admin/place_public", name="admin_place_public_index", methods={"GET"})
     */
    public function index(PlacePublicRepository $placePublicRepository): Response
    {
        return $this->render('admin/place_public/index.html.twig', [
            'place_publics' => $placePublicRepository->findAll(),
        ]);
    }

    /**
     * @Route("admin/place_public/new", name="admin_place_public", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $placePublic = new PlacePublic();
        $form = $this->createForm(AdminPlacePublicType::class, $placePublic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($placePublic);
            $entityManager->flush();

            return $this->redirectToRoute('admin_place_public_index');
        }

        return $this->render('admin/place_public/new.html.twig', [
            'place_public' => $placePublic,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("admin/place_public/{id}", name="admin_place_public_show", methods={"GET"})
     */
    public function show(PlacePublic $placePublic): Response
    {
        return $this->render('admin/place_public/show.html.twig', [
            'place_public' => $placePublic,
        ]);
    }

    /**
     * @Route("admin/place_public/{id}/edit", name="admin_place_public_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PlacePublic $placePublic): Response
    {
        $form = $this->createForm(AdminPlacePublicType::class, $placePublic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_place_public_index');
        }

        return $this->render('admin/place_public/edit.html.twig', [
            'place_public' => $placePublic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("admin/place_public/add/place/{slug}-{id}", name="add_place", requirements={"slug": "[a-z0-9\-]*"})
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
        $form = $this->createForm(AdminPlacePublicType::class, $public);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $public->setPlacePublic($spacePublic);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($public);
            $entityManager->flush();

            $this->addFlash('success','La place à bien été enregistré');

        }


        return $this->render('admin/place_public/add.html.twig', [
            'places' => $place,
            'placeForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("admin/place_public/{id}", name="admin_place_public_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PlacePublic $placePublic): Response
    {
        if ($this->isCsrfTokenValid('delete'.$placePublic->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($placePublic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_place_public_index');
    }
}
