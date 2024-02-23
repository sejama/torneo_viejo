<?php

namespace App\Controller;

use App\Entity\Cancha;
use App\Entity\Partido;
use App\Form\PartidoType;
use App\Repository\PartidoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/partido')]
class PartidoController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/', name: 'app_partido_index', methods: ['GET'])]
    public function index(PartidoRepository $partidoRepository): Response
    {
        return $this->render('partido/index.html.twig', [
            'partidos' => $partidoRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
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

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_partido_show', methods: ['GET'])]
    public function show(Partido $partido): Response
    {
        return $this->render('partido/show.html.twig', [
            'partido' => $partido,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
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

    #[IsGranted('ROLE_USER')]
    #[Route('/{id}/editar', name: 'app_partido_editar', methods: ['GET', 'POST'])]
    public function editar(
        Request $request, 
        Partido $partido, 
        PartidoRepository $pr, 
        EntityManagerInterface $entityManager
    ): Response
    {
        if ($request->isMethod('POST')) {
            $partido->setLocalSet1($request->request->get('localSet1') ? (int)$request->request->get('localSet1') : null);
            $partido->setVisitanteSet1($request->request->get('visitanteSet1') ? (int)$request->request->get('visitanteSet1') : null);
            $partido->setLocalSet2($request->request->get('localSet2') ? (int)$request->request->get('localSet2') : null);
            $partido->setVisitanteSet2($request->request->get('visitanteSet2') ? (int)$request->request->get('visitanteSet2') : null);
            $partido->setLocalSet3($request->request->get('localSet3') ? (int)$request->request->get('localSet3') : null);
            $partido->setVisitanteSet3($request->request->get('visitanteSet3') ? (int)$request->request->get('visitanteSet3') : null);
            $partido->setLocalSet4($request->request->get('localSet4') ? (int)$request->request->get('localSet4') : null);
            $partido->setVisitanteSet4($request->request->get('visitanteSet4') ? (int)$request->request->get('visitanteSet4') : null);
            $partido->setLocalSet5($request->request->get('localSet5') ? (int)$request->request->get('localSet5') : null);
            $partido->setVisitanteSet5($request->request->get('visitanteSet5') ? (int)$request->request->get('visitanteSet5') : null);
            //$partido->setUpdated($this->getUser());
            $pr->updatePartido($partido);
            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        }
        $canchas = $entityManager->getRepository(Cancha::class)->findAll();
        return $this->render('partido/editar.html.twig', [
            'partido' => $partido,
            'canchas' => $canchas
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
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
