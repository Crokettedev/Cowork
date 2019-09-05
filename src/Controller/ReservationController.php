<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\ReservationSpace;
use App\Entity\SpacePrivate;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
     * @Route("/Reservation/{slug}-{id}", name="reservation.space.private", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function reservationSpacePrivate(SpacePrivate $private, Request $request, string $slug, ObjectManager $manager): Response
    {
        if ($private->getSlug() !== $slug)
        {
            $this->redirectToRoute('reservation', [
                'id' => $private->getId(),
                'slug' => $private->getSlug()
            ], 301);
        }

        $repo = $this->getDoctrine()->getRepository(SpacePrivate::class);
        $space = $repo->find($private);

        if ($request->request->count() > 0)
        {
            $reservation = new ReservationSpace();
            $reservation->setCustomer($this->getUser());
            $reservation->setSpace($private);
            $reservation->setBeginAt($request->request->get('date1'));
            $reservation->setEndAt($request->request->get('date2'));
            $reservation->setTimeBeginAt($request->request->get('time1'));
            $reservation->setTimeEndAt($request->request->get('time2'));
            $reservation->setNameCart($request->request->get('name_cart'));
            $reservation->setNumCart($request->request->get('num_cart'));
            $reservation->setNumExp($request->request->get('num_exp'));
            $reservation->setNumCvv($request->request->get('num_cvv'));
            $reservation->setPriceTotal($request->request->get('priceTotal'));



            $manager->persist($reservation);
            $manager->flush();

            return $this->redirectToRoute('viewmyreservation');
        }

        return $this->render('reservation/reservationspaceprivate.html.twig', [
            'spacesReser' => $space
        ]);
    }
}
