<?php

namespace App\Controller;

use App\Entity\SupplyOffice;
use App\Form\SupplyOfficeType;
use App\Repository\SupplyOfficeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupplyOfficeController extends AbstractController
{
    private $office;

    public function __construct(SupplyOfficeRepository $officeRepository)
    {
        $this->office = $officeRepository;
    }

    /**
     * @Route("/Informatique", name="show_office")
     */
    public function index()
    {
        return $this->render('supply_office/index.html.twig', [
            'controller_name' => 'SupplyOfficeController',
        ]);
    }

    /**
     * Ajouter du materiel inforamtique
     * @Route("/Ajouter/Informatique", name="add_supply_office")
     */
    public function addSupplyOffice(Request $request): Response
    {
        $office = new SupplyOffice();
        $form = $this->createForm(SupplyOfficeType::class, $office);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($office);
            $entityManager->flush();

            $this->addFlash('success','Votre message à bien été envoyer, merci à vous.');

        }



        return $this->render('supply_office/add.html.twig', [
            'officeForm' => $form->createView(),
        ]);
    }
}
