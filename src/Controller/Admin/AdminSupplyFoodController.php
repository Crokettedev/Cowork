<?php

namespace App\Controller\Admin;

use App\Entity\SupplyFood;
use App\Form\AdminSupplyFoodType;
use App\Repository\SupplyFoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminSupplyFoodController extends AbstractController
{
    /**
     * @Route("admin/supply_food", name="admin_supply_food_index", methods={"GET"})
     */
    public function index(SupplyFoodRepository $supplyFoodRepository): Response
    {
        return $this->render('admin/supply_food/index.html.twig', [
            'supply_foods' => $supplyFoodRepository->findAll(),
        ]);
    }

    /**
     * @Route("admin/supply_food/new", name="admin_supply_food_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $supplyFood = new SupplyFood();
        $form = $this->createForm(AdminSupplyFoodType::class, $supplyFood);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($supplyFood);
            $entityManager->flush();

            return $this->redirectToRoute('admin_supply_food_index');
        }

        return $this->render('admin/supply_food/new.html.twig', [
            'supply_food' => $supplyFood,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("admin/supply_food/{id}", name="admin_supply_food_show", methods={"GET"})
     */
    public function show(SupplyFood $supplyFood): Response
    {
        return $this->render('admin/supply_food/show.html.twig', [
            'supply_food' => $supplyFood,
        ]);
    }

    /**
     * @Route("admin/supply_food/{id}/edit", name="admin_supply_food_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SupplyFood $supplyFood): Response
    {
        $form = $this->createForm(AdminSupplyFoodType::class, $supplyFood);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_supply_food_index');
        }

        return $this->render('admin/supply_food/edit.html.twig', [
            'supply_food' => $supplyFood,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("admin/supply_food/{id}", name="admin_supply_food_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SupplyFood $supplyFood): Response
    {
        if ($this->isCsrfTokenValid('delete'.$supplyFood->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($supplyFood);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_supply_food_index');
    }
}
