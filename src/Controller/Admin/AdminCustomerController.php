<?php

namespace App\Controller\Admin;

use App\Entity\Customer;
use App\Form\AdminCustomerType;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AdminCustomerController extends AbstractController
{
    /**
     * @Route("/admin/customer", name="admin_customer_index", methods={"GET"})
     */
    public function index(CustomerRepository $customerRepository): Response
    {
        return $this->render('admin/customer/index.html.twig', [
            'customers' => $customerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/customer/new", name="admin_customer_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        {
            $customer = new Customer();
            $form = $this->createForm(AdminCustomerType::class, $customer);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // encode the plain password
                $customer->setPassword(
                    $passwordEncoder->encodePassword(
                        $customer,
                        $form->get('plainPassword')->getData()
                    )
                );

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($customer);
                $entityManager->flush();

                // do anything else you need here, like send an email

                return $this->redirectToRoute('admin_customer_index');
            }

            return $this->render('admin/customer/new.html.twig', [
                'customer' => $customer,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/admin/customer/{id}", name="admin_customer_show", methods={"GET"})
     */
    public function show(Customer $customer): Response
    {
        return $this->render('admin/customer/show.html.twig', [
            'customer' => $customer,
        ]);
    }

    /**
     * @Route("/admin/customer/{id}/edit", name="admin_customer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Customer $customer, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(AdminCustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customer->setPassword(
                $passwordEncoder->encodePassword(
                    $customer,
                    $form->get('plainPassword')->getData()
                )
            );
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_customer_index');
        }

        return $this->render('admin/customer/edit.html.twig', [
            'customer' => $customer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/customer/{id}", name="admin_customer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Customer $customer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$customer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($customer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_customer_index');
    }
}
