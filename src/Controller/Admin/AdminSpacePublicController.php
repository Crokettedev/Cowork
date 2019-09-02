<?php

namespace App\Controller\Admin;

use App\Entity\SpacePublic;
use App\Form\AdminSpacePublicType;
use App\Repository\SpacePublicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminSpacePublicController extends AbstractController
{

    private $public;

    public  function __construct(SpacePublicRepository $public)
    {
        $this->public = $public;
    }

    /**
     * @Route("admin/place_public/add/view/place", name="admin_place_public_new")
     */
    public function viewSpace():Response
    {
        $public = $this->public->findAll();
        return $this->render('admin/place_public/new.html.twig', [
            'public' => $public,
        ]);
    }



    /**
     * @Route("/admin/space_public", name="admin_space_public_index", methods={"GET"})
     */
    public function index(SpacePublicRepository $spacePublicRepository): Response
    {
        return $this->render('admin/space_public/index.html.twig', [
            'space_publics' => $spacePublicRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/space_public/new", name="admin_space_public_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $spacePublic = new SpacePublic();
        $form = $this->createForm(AdminSpacePublicType::class, $spacePublic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($spacePublic);
            $entityManager->flush();

            return $this->redirectToRoute('admin_space_public_index');
        }

        return $this->render('admin/space_public/new.html.twig', [
            'space_public' => $spacePublic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/space_public/{id}", name="admin_space_public_show", methods={"GET"})
     */
    public function show(SpacePublic $spacePublic): Response
    {
        return $this->render('admin/space_public/show.html.twig', [
            'space_public' => $spacePublic,
        ]);
    }

    /**
     * @Route("/admin/space_public/{id}/edit", name="admin_space_public_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SpacePublic $spacePublic): Response
    {
        $form = $this->createForm(AdminSpacePublicType::class, $spacePublic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_space_public_index');
        }

        return $this->render('admin/space_public/edit.html.twig', [
            'space_public' => $spacePublic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/space_public/{id}", name="admin_space_public_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SpacePublic $spacePublic): Response
    {
        if ($this->isCsrfTokenValid('delete'.$spacePublic->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($spacePublic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_space_public_index');
    }
}
