<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\SupplyFood;
use App\Repository\CartRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private $cart;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cart = $cartRepository;
    }

    /**
     * @Route("/Panier", name="cart")
     */
    public function index()
    {

        $cartFood = $this->cart->findAll();
        return $this->render('cart/index.html.twig', [
            'cart' => $cartFood
        ]);
    }

    /**
     * @Route("/Panier/{id}", name="delete_cart", methods="DELETE")
     * @param Cart $cart
     * @return Response
     */

    public function delete(Cart $cart, Request $request, ObjectManager $manager): Response
    {
        /*
        dump('suppression');
        return new Response('Suppression')
        */
       if ($this->isCsrfTokenValid('delete'. $cart->getId(), $request->get('_token')))
       {
           $manager->remove($cart);
           $manager->flush();
       }
       return $this->redirectToRoute('cart');

    }

}
