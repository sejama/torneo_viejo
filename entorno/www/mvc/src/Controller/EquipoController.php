<?php

namespace App\Controller;

use App\Entity\Equipo;
use App\Form\EquipoType;
use App\Repository\EquipoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/equipo')]
class EquipoController extends AbstractController
{
    #[Route('/', name: 'app_equipo_index', methods: ['GET'])]
    public function index(EquipoRepository $equipoRepository): Response
    {
        return $this->render('equipo/index.html.twig', [
            'equipos' => $equipoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_equipo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {

        if ($request->isMethod('POST')) {
            $equipo = new Equipo();
            $equipo->setNombre($request->request->get('nombre'));
            $selectGen = (int)$request->request->get('select-gen');
            $selectCat = (int)$request->request->get('select-cat');
            $equipo->setTorneoGeneroCategoria($entityManager->getRepository('App\Entity\TorneoGeneroCategoria')->findOneBy(['genero' => $selectGen, 'categoria' => $selectCat]));
            $equipo->setCreatedAt(new \DateTimeImmutable());
            $equipo->setUpdatedAt(new \DateTimeImmutable());

            $entityManager->persist($equipo);
            $entityManager->flush();

            return $this->redirectToRoute('app_equipo_index', [], Response::HTTP_SEE_OTHER);
        }

        $genCat = $entityManager->getRepository('App\Entity\TorneoGeneroCategoria')->findAll();
        $generos = $entityManager->getRepository('App\Entity\Genero')->findAll();
        return $this->render('equipo/nuevo.html.twig',[
            'generos' => $generos,
            'genCat' => $genCat
        ]);
    }

    #[Route('/{id}', name: 'app_equipo_show', methods: ['GET'])]
    public function show(Equipo $equipo): Response
    {
        return $this->render('equipo/show.html.twig', [
            'equipo' => $equipo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_equipo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Equipo $equipo, EntityManagerInterface $entityManager): Response
    {
        $equipo->setUpdatedAt(new \DateTimeImmutable());
        $form = $this->createForm(EquipoType::class, $equipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_equipo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('equipo/edit.html.twig', [
            'equipo' => $equipo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_equipo_delete', methods: ['POST'])]
    public function delete(Request $request, Equipo $equipo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipo->getId(), $request->request->get('_token'))) {
            $entityManager->remove($equipo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_equipo_index', [], Response::HTTP_SEE_OTHER);
    }
}
