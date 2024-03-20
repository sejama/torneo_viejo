<?php

namespace App\Controller;

use App\Entity\Fin;
use App\Form\FinType;
use App\Repository\FinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fin')]
class FinController extends AbstractController
{
    #[Route('/', name: 'app_fin_index', methods: ['GET'])]
    public function index(FinRepository $finRepository): Response
    {
        return $this->render('fin/index.html.twig', [
            'fins' => $finRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_fin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fin = new Fin();
        $form = $this->createForm(FinType::class, $fin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($fin);
            $entityManager->flush();

            return $this->redirectToRoute('app_fin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fin/new.html.twig', [
            'fin' => $fin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fin_show', methods: ['GET'])]
    public function show(Fin $fin): Response
    {
        return $this->render('fin/show.html.twig', [
            'fin' => $fin,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fin $fin, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FinType::class, $fin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_fin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fin/edit.html.twig', [
            'fin' => $fin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fin_delete', methods: ['POST'])]
    public function delete(Request $request, Fin $fin, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fin->getId(), $request->request->get('_token'))) {
            $entityManager->remove($fin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_fin_index', [], Response::HTTP_SEE_OTHER);
    }
}
