<?php

namespace App\Controller;

use App\Entity\PlayOff;
use App\Form\PlayOffType;
use App\Repository\PlayOffRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/play/off')]
class PlayOffController extends AbstractController
{
    #[Route('/', name: 'app_play_off_index', methods: ['GET'])]
    public function index(PlayOffRepository $playOffRepository): Response
    {
        return $this->render('play_off/index.html.twig', [
            'play_offs' => $playOffRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_play_off_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $playOff = new PlayOff();
        $form = $this->createForm(PlayOffType::class, $playOff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($playOff);
            $entityManager->flush();

            return $this->redirectToRoute('app_play_off_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('play_off/new.html.twig', [
            'play_off' => $playOff,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_play_off_show', methods: ['GET'])]
    public function show(PlayOff $playOff): Response
    {
        return $this->render('play_off/show.html.twig', [
            'play_off' => $playOff,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_play_off_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlayOff $playOff, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlayOffType::class, $playOff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_play_off_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('play_off/edit.html.twig', [
            'play_off' => $playOff,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_play_off_delete', methods: ['POST'])]
    public function delete(Request $request, PlayOff $playOff, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$playOff->getId(), $request->request->get('_token'))) {
            $entityManager->remove($playOff);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_play_off_index', [], Response::HTTP_SEE_OTHER);
    }
}
