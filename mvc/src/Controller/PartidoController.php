<?php

namespace App\Controller;

use App\Entity\Partido;
use App\Form\PartidoType;
use App\Repository\PartidoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/partido')]
class PartidoController extends AbstractController
{
    #[Route('/', name: 'app_partido_index', methods: ['GET'])]
    public function index(PartidoRepository $partidoRepository): Response
    {
        return $this->render('partido/index.html.twig', [
            'partidos' => $partidoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_partido_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $partido = new Partido();
        $form = $this->createForm(PartidoType::class, $partido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($partido);
            $entityManager->flush();

            return $this->redirectToRoute('app_partido_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('partido/new.html.twig', [
            'partido' => $partido,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_partido_show', methods: ['GET'])]
    public function show(Partido $partido): Response
    {
        return $this->render('partido/show.html.twig', [
            'partido' => $partido,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_partido_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Partido $partido, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PartidoType::class, $partido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_partido_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('partido/edit.html.twig', [
            'partido' => $partido,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_partido_delete', methods: ['POST'])]
    public function delete(Request $request, Partido $partido, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partido->getId(), $request->request->get('_token'))) {
            $entityManager->remove($partido);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_partido_index', [], Response::HTTP_SEE_OTHER);
    }
}
