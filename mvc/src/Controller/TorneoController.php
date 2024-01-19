<?php

namespace App\Controller;

use App\Entity\Torneo;
use App\Form\TorneoType;
use App\Manager\TorneoManager;
use App\Repository\TorneoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/torneo')]
class TorneoController extends AbstractController
{
    #[Route('/', name: 'app_torneo_index', methods: ['GET'])]
    public function index(TorneoRepository $torneoRepository): Response
    {
        return $this->render('torneo/index.html.twig', [
            'torneos' => $torneoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_torneo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $torneo = new Torneo();
        $torneo->setCreatedAt(new \DateTimeImmutable());
        $torneo->setUpdatedAt(new \DateTimeImmutable());
        $form = $this->createForm(TorneoType::class, $torneo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($torneo);
            $entityManager->flush();

            return $this->redirectToRoute('app_torneo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('torneo/new.html.twig', [
            'torneo' => $torneo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_torneo_show', methods: ['GET'])]
    public function show(Torneo $torneo): Response
    {
        return $this->render('torneo/show.html.twig', [
            'torneo' => $torneo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_torneo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Torneo $torneo, EntityManagerInterface $entityManager): Response
    {
        $torneo->setUpdatedAt(new \DateTimeImmutable());
        $form = $this->createForm(TorneoType::class, $torneo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_torneo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('torneo/edit.html.twig', [
            'torneo' => $torneo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_torneo_delete', methods: ['POST'])]
    public function delete(Request $request, Torneo $torneo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$torneo->getId(), $request->request->get('_token'))) {
            $entityManager->remove($torneo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_torneo_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/armarZona/', name: 'app_torneo_armar_zona', methods: ['POST'])]
    public function armarZona(Request $request, TorneoManager $tm): Response
    {
        $idTorneoGeneroCategoria = (int)$request->get('id');
        $cantidadZonas = (int)$request->request->count();
        $array = [];
        for ($i=0; $i < $cantidadZonas; $i++) { 
            $array[] = (int)$request->request->get('cantidadEquiposZona'.$idTorneoGeneroCategoria.$i);
        }
        $tm->armadoFixture($idTorneoGeneroCategoria, $cantidadZonas, $array);

        return $this->redirectToRoute('app_main');
    }
}
