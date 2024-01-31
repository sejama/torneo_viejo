<?php

namespace App\Controller;

use App\Entity\Zona;
use App\Form\ZonaType;
use App\Manager\ZonaManager;
use App\Repository\ZonaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/zona')]
class ZonaController extends AbstractController
{
    #[Route('/', name: 'app_zona_index', methods: ['GET'])]
    public function index(ZonaRepository $zonaRepository): Response
    {
        return $this->render('zona/index.html.twig', [
            'zonas' => $zonaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_zona_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $zona = new Zona();
        $form = $this->createForm(ZonaType::class, $zona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($zona);
            $entityManager->flush();

            return $this->redirectToRoute('app_zona_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('zona/new.html.twig', [
            'zona' => $zona,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_zona_show', methods: ['GET'])]
    public function show(Zona $zona, ZonaManager $zm ): Response
    {   
        $posiciones = $zm->calcularPosiciones($zona->getId());
        return $this->render('zona/show.html.twig', [
            'zona' => $zona,
            'posiciones' => $posiciones
        ]);
    }

    #[Route('/{id}/edit', name: 'app_zona_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Zona $zona, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ZonaType::class, $zona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_zona_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('zona/edit.html.twig', [
            'zona' => $zona,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_zona_delete', methods: ['POST'])]
    public function delete(Request $request, Zona $zona, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$zona->getId(), $request->request->get('_token'))) {
            $entityManager->remove($zona);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_zona_index', [], Response::HTTP_SEE_OTHER);
    }
}
