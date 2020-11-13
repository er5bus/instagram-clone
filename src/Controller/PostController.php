<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\ImageFile;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class PostController extends AbstractController
{
  /**
   * @Route("/", name="post_index", methods={"GET"})
   */
  public function index(PostRepository $postRepository): Response
  {
    return $this->render('post/index.html.twig', [
      'posts' => $postRepository->findByUser($this->getUser()),
    ]);
  }

  /**
   * @Route("/new-post", name="post_new", methods={"GET","POST"})
   */
  public function new(Request $request): Response
  {
    $post = new Post();
    $form = $this->createForm(PostType::class, $post);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager = $this->getDoctrine()->getManager();
      $files = $form->get("files", [])->getData();
      foreach($files as $file){
        $file = (new ImageFile())
          ->setFileName($file->getClientOriginalName())
          ->setFileSize($file->getClientSize())
          ->setFile($file)
          ->setPost($post)
        ;
        $entityManager->persist($file);
      }

      $post->setAuthor($this->getUser());
      $entityManager->persist($post);
      $entityManager->flush();

      return $this->redirectToRoute('post_index');
    }

    return $this->render('post/new.html.twig', [
      'post' => $post,
      'form' => $form->createView(),
    ]);
  }

  /**
   * @Route("/post/{id}", name="post_show", methods={"GET"})
   */
  public function show(Post $post): Response
  {
    return $this->render('post/show.html.twig', [
      'post' => $post,
    ]);
  }
}
