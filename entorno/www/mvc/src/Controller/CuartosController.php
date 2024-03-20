<?php

namespace App\Controller;

use App\Entity\Cuartos;
use App\Form\CuartosType;
use App\Repository\CuartosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cuartos')]
class CuartosController extends AbstractController
{
    #[Route('/', name: 'app_cuartos_index', methods: ['GET'])]
    public function index(CuartosRepository $cuartosRepository): Response
    {
        return $this->render('cuartos/index.html.twig', [
            'cuartos' => $cuartosRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cuartos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cuarto = new Cuartos();
        $form = $this->createForm(CuartosType::class, $cuarto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cuarto);
            $entityManager->flush();

            return $this->redirectToRoute('app_cuartos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cuartos/new.html.twig', [
            'cuarto' => $cuarto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cuartos_show', methods: ['GET'])]
    public function show(Cuartos $cuarto): Response
    {
        return $this->render('cuartos/show.html.twig', [
            'cuarto' => $cuarto,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cuartos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cuartos $cuarto, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CuartosType::class, $cuarto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cuartos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cuartos/edit.html.twig', [
            'cuarto' => $cuarto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cuartos_delete', methods: ['POST'])]
    public function delete(Request $request, Cuartos $cuarto, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cuarto->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cuarto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cuartos_index', [], Response::HTTP_SEE_OTHER);
    }
}
