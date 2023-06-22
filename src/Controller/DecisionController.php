<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Decision;
use App\Entity\User;
use App\Form\DecisionType;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\DecisionRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/decision')]
class DecisionController extends AbstractController
{
    #[Route('/', name: 'app_decision_index', methods: ['GET', 'POST'])]
    public function index(DecisionRepository $decisionRepository): Response
    {
        return $this->render('decision/index.html.twig', [
            'decisions' => $decisionRepository->findAll(),
        ]);
    }

    #[Route('/ajouter', name: 'app_decision_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DecisionRepository $decisionRepository): Response
    {
        $decision = new Decision();
        $form = $this->createForm(DecisionType::class, $decision);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $decisionRepository->save($decision, true);

            return $this->redirectToRoute('app_decision_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('decision/new.html.twig', [
            'decision' => $decision,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_decision_show', methods: ['GET', 'POST'])]
    public function show(Request $request, Decision $decision, CommentRepository $commentRepository): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUser($this->getUser());
            $comment->setDecision($decision);
            $commentRepository->save($comment, true);

            return $this->redirectToRoute('app_decision_show', ['id' => $decision->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('decision/show.html.twig', [
            'decision' => $decision,
            'form' => $form

        ]);
    }

    #[Route('/{id}/edit', name: 'app_decision_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Decision $decision, DecisionRepository $decisionRepository): Response
    {
        $form = $this->createForm(DecisionType::class, $decision);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $decisionRepository->save($decision, true);

            return $this->redirectToRoute('app_decision_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('decision/edit.html.twig', [
            'decision' => $decision,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_decision_delete', methods: ['POST'])]
    public function delete(Request $request, Decision $decision, DecisionRepository $decisionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $decision->getId(), $request->request->get('_token'))) {
            $decisionRepository->remove($decision, true);
        }

        return $this->redirectToRoute('app_decision_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/approve', name: 'approve', methods: ["GET", "POST"])]
    public function addToApprove(Decision $decision, UserRepository $userRepository): Response
    {
        /** @var \App\Entity\User */
        $user = $this->getUser();
        if ($user->isApprove($decision)) {
            $user->removeApprove($decision);
        } else {
            $user->addApprove($decision);
        }
        $userRepository->save($user, true);

        return $this->json(['isApprove' => $this->getUser()->isApprove($decision)]);
    }
}
