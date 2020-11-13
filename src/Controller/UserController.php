<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
  /**
   * @Route("/users", name="user_index")
   */
  public function index(UserRepository $repository)
  {
    return $this->render('user/index.html.twig', [
      'users' => $repository->findAllUsers($this->getUser()),
    ]);
  }

  /**
   * @Route("/user/{id}", name="user_show")
   */
  public function show(User $user)
  {
    return $this->render('user/show.html.twig', [
      'user' => $user,
    ]);

  }
}
