<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\SupplyFood;
use App\Form\AddFoodCartType;
use App\Form\SupplyFoodType;
use App\Repository\SupplyFoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupplyFoodController extends AbstractController
{
    private $food;

    public function __construct(SupplyFoodRepository $foodRepository)
    {
        $this->food = $foodRepository;
    }

    /**
     * @Route("/Carte", name="show_cart")
     */
    public function showCarte(Request $request)
    {

        $cart = new Cart();
        $form = $this->createForm(AddFoodCartType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cart->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cart);
            $entityManager->flush();

            $this->addFlash('success','Votre message à bien été envoyer, merci à vous.');

        }
        $food = $this->food->findByLabel5();
        return $this->render('supply_food/index.html.twig', [
            'menuForm' => $form->createView(),
            'showMenu' => $food
        ]);
    }

    /**
     * @Route("/Plats", name="show_menu")
     */
    public function showFood()
    {
        $food = $this->food->findByLabel1();
        return $this->render('supply_food/food.html.twig', [
            'showFood' => $food,
        ]);
    }

    /**
     * @Route("/Boissons", name="show_drink")
     */
    public function showDrinks()
    {
        $drink = $this->food->findByLabel2();
        return $this->render('supply_food/drink.html.twig', [
            'showDrink'=> $drink,
        ]);
    }

    /**
     * @Route("/Cafées", name="show_coffee")
     */
    public function showCoffee()
    {
        $drink = $this->food->findByLabel3();
        return $this->render('supply_food/coffee.html.twig', [
            'showCoffee'=> $drink,
        ]);
    }

    /**
     * @Route("/Fruits", name="show_fruit")
     */
    public function showFruits()
    {
        $drink = $this->food->findByLabel4();
        return $this->render('supply_food/fruits.html.twig', [
            'showFruit'=> $drink,
        ]);
    }

    /**
     * @Route("/add/supply/food", name="supply_food_add")
     */
    public function addFood(Request $request): Response
    {
        $food = new SupplyFood();
        $form = $this->createForm(SupplyFoodType::class, $food);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($food);
            $entityManager->flush();

            $this->addFlash('success','Votre message à bien été envoyer, merci à vous.');

        }

        return $this->render('supply_food/new.html.twig', [
            'foodForm' => $form->createView(),
        ]);
    }
}
