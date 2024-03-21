<?php

namespace App\Controller;

use App\Entity\TorneoGeneroCategoria;
use App\Form\TorneoGeneroCategoriaType;
use App\Manager\ZonaManager;
use App\Repository\TorneoGeneroCategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/torneo/genero/categoria')]
class TorneoGeneroCategoriaController extends AbstractController
{
    #[Route('/', name: 'app_torneo_genero_categoria_index', methods: ['GET'])]
    public function index(TorneoGeneroCategoriaRepository $torneoGeneroCategoriaRepository): Response
    {
        return $this->render('torneo_genero_categoria/index.html.twig', [
            'torneo_genero_categorias' => $torneoGeneroCategoriaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_torneo_genero_categoria_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $torneoGeneroCategorium = new TorneoGeneroCategoria();
        $torneoGeneroCategorium->setCreatedAt(new \DateTimeImmutable());
        $torneoGeneroCategorium->setUpdatedAt(new \DateTimeImmutable());
        $form = $this->createForm(TorneoGeneroCategoriaType::class, $torneoGeneroCategorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($torneoGeneroCategorium);
            $entityManager->flush();

            return $this->redirectToRoute('app_torneo_genero_categoria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('torneo_genero_categoria/new.html.twig', [
            'torneo_genero_categorium' => $torneoGeneroCategorium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_torneo_genero_categoria_playoff', methods: ['GET'])]
    public function armarplayoff(
        TorneoGeneroCategoria $torneoGeneroCategorium,
        ZonaManager $zonaManager
    ): Response
    {
        $zonas = [];
        foreach ($torneoGeneroCategorium->getZonas() as $zona) {
            $zonas[] = $zonaManager->calcularPosiciones($zona->getId());
        }
        return $this->render('torneo_genero_categoria/armarplayoff.html.twig', [
            'torneo_genero_categorium' => $torneoGeneroCategorium,
            'zonas' => $zonas,

        ]);
    }

    #[Route('/{id}', name: 'app_torneo_genero_categoria_show', methods: ['GET'])]
    public function show(TorneoGeneroCategoria $torneoGeneroCategorium): Response
    {
        return $this->render('torneo_genero_categoria/show.html.twig', [
            'torneo_genero_categorium' => $torneoGeneroCategorium,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_torneo_genero_categoria_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TorneoGeneroCategoria $torneoGeneroCategorium, EntityManagerInterface $entityManager): Response
    {
        $torneoGeneroCategorium->setUpdatedAt(new \DateTimeImmutable());
        $form = $this->createForm(TorneoGeneroCategoriaType::class, $torneoGeneroCategorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_torneo_genero_categoria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('torneo_genero_categoria/edit.html.twig', [
            'torneo_genero_categorium' => $torneoGeneroCategorium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_torneo_genero_categoria_delete', methods: ['POST'])]
    public function delete(Request $request, TorneoGeneroCategoria $torneoGeneroCategorium, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$torneoGeneroCategorium->getId(), $request->request->get('_token'))) {
            $entityManager->remove($torneoGeneroCategorium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_torneo_genero_categoria_index', [], Response::HTTP_SEE_OTHER);
    }
}
