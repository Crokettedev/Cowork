<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\JobPosts;
use App\Entity\RegisterPost;
use App\Form\AddJobPostType;
use App\Form\ResetPasswordType;
use App\Form\UpdateCustomerType;
use App\Repository\CustomerRepository;
use App\Repository\JobPostsRepository;
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
    private $jobPostsRepository;

    public function __construct(CustomerRepository $repository, ObjectManager $em, JobPostsRepository $jobPostsRepository)
    {
        $this->repository = $repository;
        $this->em = $em;
        $this->jobPostsRepository = $jobPostsRepository;

    }

    /**
     * @Route("/Reseau", name="mynetwork")
     */
    public function viewNetwork()
    {
        $jobPost = $this->jobPostsRepository->findAllPost();
        return $this->render('customer/mynetwork.html.twig', [
            'jobPost' => $jobPost,
        ]);
    }

    /**
     * @Route("/Mes/Posts", name="myjobpost")
     */
    public function viewmyjobPost()
    {
        return $this->render('customer/myjobpost.html.twig');
    }

    /**
     * @Route("/Ajouter/Posts", name="addjobpost")
     * @return Response
     */
    public function addjobPost( Request $request): Response
    {
        $addjobPost = new JobPosts();
        $form = $this->createForm(AddJobPostType::class, $addjobPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $addjobPost->setCustomer($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($addjobPost);
            $entityManager->flush();

            return $this->redirectToRoute('myjobpost');
        }

        return $this->render('customer/addjobpost.html.twig', [
            'addJobPostForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/Mes/Posts/{id}", name="delete_jobpost", methods="DELETE")
     * @param JobPosts $jobPosts
     * @return Response
     */
    public function delete_jobpost(JobPosts $jobPosts, Request $request, ObjectManager $manager): Response
    {
        if ($this->isCsrfTokenValid('delete'. $jobPosts->getId(), $request->get('_token')))
        {
            $manager->remove($jobPosts);
            $manager->flush();
        }

        return $this->redirectToRoute('myjobpost');
    }

    /**
     * @Route("/Mes/Posts/{id}", name="delete_allpost", methods="DELETE")
     * @param JobPosts $jobPosts
     * @return Response
     */
    public function delete_allpost(JobPosts $jobPosts, Request $request, ObjectManager $manager): Response
    {
        if ($this->isCsrfTokenValid('delete'. $jobPosts->getCustomer(), $request->get('_token')))
        {
            $manager->remove($jobPosts);
            $manager->flush();
        }

        return $this->redirectToRoute('myjobpost');
    }

    /**
     * @Route("/Repondre/{slug}-{id}", name="answerjobpost", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function answerjobpost(JobPosts $jobPosts, Request $request, string $slug)
    {
        if ($jobPosts->getSlug() !== $slug)
        {
            $this->redirectToRoute('add_food', [
                'id' => $jobPosts->getId(),
                'slug' => $jobPosts->getSlug()
            ], 301);
        }

        $repo = $this->getDoctrine()->getRepository(JobPosts::class);
        $job = $repo->find($jobPosts);

        return $this->render('customer/answerjobpost.html.twig', [
            'jobs' => $job,
        ]);

    }

    /**
     * @Route("/MonCompte/{id}", name="customer_count")
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

    /**
     * @Route("/Mes/Evenements", name="myevent")
     */
    public function showCoffee()
    {
        return $this->render('customer/myevent.html.twig');
    }

    /**
     * @Route("/Mes/Evenements/{id}", name="delete_event", methods="DELETE")
     * @param RegisterPost $registerPost
     * @return Response
     */
    public function delete_event(RegisterPost $registerPost, Request $request, ObjectManager $manager): Response
    {
        /*
        dump('suppression');
        return new Response('Suppression')
        */
        if ($this->isCsrfTokenValid('delete'. $registerPost->getId(), $request->get('_token')))
        {
            $manager->remove($registerPost);
            $manager->flush();
        }

        return $this->redirectToRoute('myevent');

    }

}
