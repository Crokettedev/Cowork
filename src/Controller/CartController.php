<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Command;
use App\Entity\CommandBis;
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

    /**
     * @Route("/Shop", name="shop")
     */
    public function shop(){
        return $this->render('shop/index.html.twig');
    }
    /**
     * @Route("/Paiement", name="paiement")
     */
    public function paiement(Request $request, ObjectManager $manager){
        $cartFood = $this->cart->findAll();

        if ($request->request->count() > 0)
        {
            $paiment = new Command();
            $paiment->setFirstname($request->request->get('firstname'));
            $paiment->setLastname($request->request->get('lastname'));
            $paiment->setEmail($request->request->get('email'));
            $paiment->setAdress($request->request->get('adress'));
            $paiment->setNameCart($request->request->get('name_cart'));
            $paiment->setNumCart($request->request->get('num_cart'));
            $paiment->setNumExp($request->request->get('num_exp'));
            $paiment->setNumCvv($request->request->get('num_cvv'));
            $paiment->setSupply($request->request->get('supply_id'));
            $paiment->setCommandPrice($request->request->get('totalPrice'));
            $paiment->setCreatedAt(new \DateTime());

            $manager->persist($paiment);
            $manager->flush();
        }



        return $this->render('paiement/index.html.twig', [
            'cart' => $cartFood
        ]);

    }
}
