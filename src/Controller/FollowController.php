<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Follow;
use App\Repository\FollowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class FollowController extends AbstractController
{
  /**
   * @Route("/follow/{id}", name="follow")
   */
  public function follow(User $user, Request $request, FollowRepository $repository)
  {
    $follow = $repository->findByFollower($this->getUser(), $user);
    if (!$follow){
      $follow = (new Follow())
        ->setCreatedAt(new \DateTime())
        ->setFollower($this->getUser())
        ->setFollowed($user)
      ;
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($follow);
      $entityManager->flush();
    }
    if (!is_null($request->headers->get('referer'))){
      return $this->redirect($request->headers->get('referer'));
    }

    return $this->redirectToRoute('post_index');
  }

  /**
   * @Route("/unfollow/{id}", name="unfollow")
   */
  public function unfollow(User $user, Request $request, FollowRepository $repository)
  {
    $follow = $repository->findByFollower($this->getUser(), $user);
    if ($follow){
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->remove($follow);
      $entityManager->flush();
    }
    if (!is_null($request->headers->get('referer'))){
      return $this->redirect($request->headers->get('referer'));
    }

    return $this->redirectToRoute('post_index');
  }
}
