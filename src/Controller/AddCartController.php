<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\SupplyFood;
use App\Form\AddCartType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddCartController extends AbstractController
{

    /**
     * @Route("/Ajouter/{slug}-{id}", name="add_supply_food", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function addFoodInCart(SupplyFood $supplyFood, Request $request, string $slug): Response
    {
        if ($supplyFood->getSlug() !== $slug)
        {
            $this->redirectToRoute('add_food', [
                'id' => $supplyFood->getId(),
                'slug' => $supplyFood->getSlug()
            ], 301);
        }
        $repo = $this->getDoctrine()->getRepository(SupplyFood::class);
        $food = $repo->find($supplyFood);

        $cart = new Cart();
        $form = $this->createForm(AddCartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $cart->setFood($supplyFood);
            //$cart->setOffice($supplyOffice);
            //$cart->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cart);
            $entityManager->flush();

            $this->addFlash('success','Votre article à bien été ajouter au panier.');
        }

        return $this->render('add_cart/index.html.twig', [
            'food' => $food,
            'addFoodForm' => $form->createView()
        ]);
    }


}
