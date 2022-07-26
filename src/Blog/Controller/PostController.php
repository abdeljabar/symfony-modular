<?php

namespace App\Blog\Controller;

use App\Blog\Entity\Post;
use App\Blog\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(PostRepository $postRepository): JsonResponse
    {
        $posts = $postRepository->findAll();
        dd($posts);
        return new JsonResponse(['message' => 'This is OK!']);
    }

    /**
     * @Route("/create")
     */
    public function create(EntityManagerInterface $entityManager): JsonResponse
    {
        $post1 = new Post();
        $post1->setTitle('hello world');
        $entityManager->persist($post1);

        $post2 = new Post();
        $post2->setTitle('hello makai');
        $entityManager->persist($post2);

        $entityManager->flush();

        return new JsonResponse(['message' => 'Posts created!']);
    }
}