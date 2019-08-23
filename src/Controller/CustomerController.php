<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\ResetPasswordType;
use App\Form\UpdateCustomerType;
use App\Repository\CustomerRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CustomerController extends AbstractController
{
    private $em;
    private $repository;
    protected $oldPassword;

    public function __construct(CustomerRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;

    }

    /**
     * @Route("/customer", name="customer")
     */
    public function index()
    {
        return $this->render('customer/index.html.twig', [
            'controller_name' => 'CustomerController',
        ]);
    }

    /**
     * @Route("/accounts/edit/{id}", name="customer_count")
     * @param Customer $customer
     * @return Response
     */
    public function editInformation(Customer $customer, Request $request):Response
    {
        $repo = $this->getDoctrine()->getRepository(Customer::class);
        $show = $repo->find($customer);

        $user = new Customer();
        $form = $this->createForm(UpdateCustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            $this->addFlash('success','Vos informations ont bien été changé.');
        }

        return $this->render('customer/show.html.twig', [
            'customerForm' => $form->createView(),
            'customer' => $show,
        ]);
    }

    /**
     * @Route("/resetPassword/{id}", name="reset_password")
     * @param Request $request
     * @return Response
     */
    public function resetPasswordAction(Request $request, Customer $customer, UserPasswordEncoderInterface $passwordEncoder)
    {
        $repo = $this->getDoctrine()->getRepository(Customer::class);
        $show = $repo->find($customer);

        $user = new Customer();
        $form = $this->createForm(ResetPasswordType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customer->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $this->em->flush();

            $this->addFlash('success','Vos informations ont bien été changé.');
        }

        return $this->render('customer/resetPassword.html.twig', [
            'resetForm' => $form->createView(),
            'customer' => $show,
        ]);
    }

}
