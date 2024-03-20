<?php

namespace App\Controller;

use App\Entity\Semis;
use App\Form\SemisType;
use App\Repository\SemisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/semis')]
class SemisController extends AbstractController
{
    #[Route('/', name: 'app_semis_index', methods: ['GET'])]
    public function index(SemisRepository $semisRepository): Response
    {
        return $this->render('semis/index.html.twig', [
            'semis' => $semisRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_semis_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $semi = new Semis();
        $form = $this->createForm(SemisType::class, $semi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($semi);
            $entityManager->flush();

            return $this->redirectToRoute('app_semis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('semis/new.html.twig', [
            'semi' => $semi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_semis_show', methods: ['GET'])]
    public function show(Semis $semi): Response
    {
        return $this->render('semis/show.html.twig', [
            'semi' => $semi,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_semis_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Semis $semi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SemisType::class, $semi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_semis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('semis/edit.html.twig', [
            'semi' => $semi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_semis_delete', methods: ['POST'])]
    public function delete(Request $request, Semis $semi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$semi->getId(), $request->request->get('_token'))) {
            $entityManager->remove($semi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_semis_index', [], Response::HTTP_SEE_OTHER);
    }
}
