<?php

namespace App\Controller;

use App\Entity\Zona;
use App\Entity\ZonaEquipo;
use App\Form\ZonaEquipoType;
use App\Repository\ZonaEquipoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/zona_equipo')]
class ZonaEquipoController extends AbstractController
{
    #[Route('/', name: 'app_zona_equipo_index', methods: ['GET'])]
    public function index(ZonaEquipoRepository $zonaEquipoRepository): Response
    {
        return $this->render('zona_equipo/index.html.twig', [
            'zona_equipos' => $zonaEquipoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_zona_equipo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $zonaEquipo = new ZonaEquipo();
        $form = $this->createForm(ZonaEquipoType::class, $zonaEquipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($zonaEquipo);
            $entityManager->flush();

            return $this->redirectToRoute('app_zona_equipo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('zona_equipo/new.html.twig', [
            'zona_equipo' => $zonaEquipo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_zona_equipo_show', methods: ['GET'])]
    public function show(ZonaEquipo $zonaEquipo): Response
    {
        return $this->render('zona_equipo/show.html.twig', [
            'zona_equipo' => $zonaEquipo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_zona_equipo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ZonaEquipo $zonaEquipo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ZonaEquipoType::class, $zonaEquipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_zona_equipo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('zona_equipo/edit.html.twig', [
            'zona_equipo' => $zonaEquipo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_zona_equipo_delete', methods: ['POST'])]
    public function delete(Request $request, ZonaEquipo $zonaEquipo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$zonaEquipo->getId(), $request->request->get('_token'))) {
            $entityManager->remove($zonaEquipo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_zona_equipo_index', [], Response::HTTP_SEE_OTHER);
    }
}
