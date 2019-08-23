<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Posts;
use App\Entity\RegisterPost;
use App\Entity\User;
use App\Form\RegisterPostType;
use App\Form\RegisterPostUserType;
use App\Repository\RegisterPostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegisterPostController extends AbstractController
{
    private $registerPost;

    public function __construct(RegisterPostRepository $registerPostRepository)
    {
        $this->registerPost = $registerPostRepository;
    }

    /**
     * @Route("/register/post/{id}", name="register_post")
     */
    public function index(Posts $posts, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Posts::class);
        $post = $repo->find($posts);

        $register = new RegisterPost();
        $form = $this->createForm(RegisterPostType::class, $register);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $register->setPost($posts);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($register);
            $entityManager->flush();

            $this->addFlash('success','La place à bien été enregistré');

        }

        return $this->render('register_post/index.html.twig', [
            'post' => $post,
            'registerPostForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/Evenement/{id}", name="register_post")
     */
    public function registerNoUser(Posts $posts, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Posts::class);
        $post = $repo->find($posts);


        $register = new RegisterPost();
        $form = $this->createForm(RegisterPostType::class, $register);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $register->setPost($posts);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($register);
            $entityManager->flush();

            $this->addFlash('success','Vous êtes bien inscrit a cette evévenement');

        }


        return $this->render('register_post/index.html.twig', [
            'post' => $post,
            'registerPostForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/register/user/{id}", name="register_post_user")
     */
    public function registerUser(Posts $posts, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Posts::class);
        $post = $repo->find($posts);


        $register = new RegisterPost();
        $form = $this->createForm(RegisterPostUserType::class, $register);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $register->setPost($posts);
            $register->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($register);
            $entityManager->flush();

            $this->addFlash('success','Vous êtes bien inscrit a cette evévenement');

        }


        return $this->render('register_post/index.html.twig', [
            'post' => $post,
            'registerPostFormUser' => $form->createView()
        ]);
    }

}
