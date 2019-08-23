<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Form\PostsType;
use App\Repository\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostsController extends AbstractController
{
    private $posts;

    public function __construct(PostsRepository $postsRepository)
    {
        $this->posts = $postsRepository;
    }

    /**
     * @Route("/évenement/{id}", name="view_event")
     */
    public function showInHome()
    {
        $post = $this->posts->findAll();
        return $this->render('posts/index.html.twig', [
            'Post' => $post
        ]);
    }

    /**
     * @Route("/add/posts", name="add_posts")
     */
    public function addPosts(Request $request): Response
    {
        $posts = new Posts();
        $form = $this->createForm(PostsType::class, $posts);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($posts);
            $entityManager->flush();

            $this->addFlash('success','Votre message à bien été envoyer, merci à vous.');

        }
        return $this->render('posts/new.html.twig', [
            'postForm' => $form->createView()
        ]);
    }
}
