<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin_')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    #[Route('/user', name: 'user_index', methods: ['GET'])]
    public function userIndex(UserRepository $userRepository): Response
    {
        return $this->render('admin/admin_user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/user/{id}/activate', name: 'user_activate', methods: ['POST'])]
    public function userActivate(User $user, UserRepository $userRepository): Response
    {
        $user->setIsActivated(true);
        $userRepository->save($user, true);

        return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/user/{id}/deactivate', name: 'user_desactivate', methods: ['POST'])]
    public function userDeactivate(User $user, UserRepository $userRepository): Response
    {
        $user->setIsActivated(false);
        $userRepository->save($user, true);

        return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
