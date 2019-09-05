<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\JobPosts;
use App\Entity\MessageJob;
use App\Entity\RegisterPost;
use App\Form\AddJobPostType;
use App\Form\ResetPasswordType;
use App\Form\UpdateCustomerType;
use App\Form\UpdateJobPostType;
use App\Repository\CustomerRepository;
use App\Repository\JobPostsRepository;
use App\Repository\MessageJobRepository;
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
    private $messageJobRepo;

    public function __construct(CustomerRepository $repository, ObjectManager $em, JobPostsRepository $jobPostsRepository, MessageJobRepository $messageJobRepository)
    {
        $this->repository = $repository;
        $this->em = $em;
        $this->jobPostsRepository = $jobPostsRepository;
        $this->messageJobRepo = $messageJobRepository;

    }

    /**
     * @Route("/Reseau", name="mynetwork")
     */
    public function viewNetwork()
    {
        $jobPost = $this->jobPostsRepository->findAllPost();
        $msg = $this->messageJobRepo->findAll();
        return $this->render('customer/mynetwork.html.twig', [
            'jobPost' => $jobPost,
            'msgPost' => $msg
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
     * @Route("/Message", name="viewmymessagejob")
     */
    public function viewmymessagejob()
    {
        return $this->render('customer/messagejob.html.twig');
    }

    /**
     * @Route("/Reservation", name="viewmyreservation")
     */
    public function viewmyreservation()
    {
        return $this->render('customer/myreservation.html.twig');
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

            return $this->redirectToRoute('mynetwork');
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
    public function answerjobpost(JobPosts $jobPosts, Request $request, string $slug, ObjectManager $manager)
    {
        if ($jobPosts->getSlug() !== $slug)
        {
            $this->redirectToRoute('answerjobpost', [
                'id' => $jobPosts->getId(),
                'slug' => $jobPosts->getSlug()
            ], 301);
        }

        $repo = $this->getDoctrine()->getRepository(JobPosts::class);
        $job = $repo->find($jobPosts);

        if ($request->request->count() > 0)
        {
            $message = new MessageJob();
            $message->setMessage($jobPosts);
            $message->setCustomerMsg($this->getUser());
            $message->setContent($request->request->get('message'));
            $message->setCreatedAt(new \DateTime('now'));

            $manager->persist($message);
            $manager->flush();

            $this->addFlash('success','Vos informations ont bien été changé.');
        }

        return $this->render('customer/answerjobpost.html.twig', [
            'jobs' => $job,
        ]);

    }

    /**
     * @Route("/Editer/{slug}-{id}", name="editjobpost", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function editjobpost(JobPosts $jobPosts, Request $request, string $slug, ObjectManager $manager)
    {
        if ($jobPosts->getSlug() !== $slug)
        {
            $this->redirectToRoute('answerjobpost', [
                'id' => $jobPosts->getId(),
                'slug' => $jobPosts->getSlug()
            ], 301);
        }

        $repo = $this->getDoctrine()->getRepository(JobPosts::class);
        $job = $repo->find($jobPosts);

        $form = $this->createForm(UpdateJobPostType::class, $jobPosts);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('myjobpost');
        }

        return $this->render('customer/editJobPost.html.twig', [
            'jobs' => $job,
            'editJobForm' => $form->createView(),
        ]);

    }

    /**
     * @Route("/Discussion/{slug}-{id}", name="discussionJobPost", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function discussionJobPost(JobPosts $jobPosts, Request $request, string $slug, ObjectManager $manager)
    {
        if ($jobPosts->getSlug() !== $slug)
        {
            $this->redirectToRoute('answerjobpost', [
                'id' => $jobPosts->getId(),
                'slug' => $jobPosts->getSlug()
            ], 301);
        }

        $repo = $this->getDoctrine()->getRepository(JobPosts::class);
        $job = $repo->find($jobPosts);

        if ($request->request->count() > 0)
        {
            $message = new MessageJob();
            $message->setMessage($jobPosts);
            $message->setCustomerMsg($this->getUser());
            $message->setContent($request->request->get('message'));
            $message->setCreatedAt(new \DateTime('now'));

            $manager->persist($message);
            $manager->flush();

            $this->redirectToRoute('discussionJobPost', [
                'id' => $jobPosts->getId(),
                'slug' => $jobPosts->getSlug()
            ], 301);
        }


        return $this->render('customer/discJobPost.html.twig', [
            'jobs' => $job,
        ]);

    }

    /**
     * @Route("/Discussion/{slug}-{id}", name="delete_msgdiscpost", methods="DELETE")
     * @param MessageJob $messageJob
     * @return Response
     */
    public function delete_msgdiscpost(MessageJob $messageJob, Request $request, ObjectManager $manager, string $slug): Response
    {
        if ($messageJob->getSlug() !== $slug)
        {
            $this->redirectToRoute('answerjobpost', [
                'id' => $messageJob->getId(),
                'slug' => $messageJob->getSlug()
            ], 301);
        }

        if ($this->isCsrfTokenValid('delete'. $messageJob->getId(), $request->get('_token')))
        {
            $manager->remove($messageJob);
            $manager->flush();
        }

        $this->redirectToRoute('discussionJobPost', [
            'id' => $messageJob->getId(),
            'slug' => $messageJob->getSlug()
        ], 301);
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
