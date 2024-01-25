<?php

namespace App\Controller;

use App\Entity\Cancha;
use App\Form\CanchaType;
use App\Repository\CanchaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[IsGranted('ROLE_ADMIN')]
#[Route('/cancha')]
class CanchaController extends AbstractController
{
    #[Route('/', name: 'app_cancha_index', methods: ['GET'])]
    public function index(CanchaRepository $canchaRepository): Response
    {
        return $this->render('cancha/index.html.twig', [
            'canchas' => $canchaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cancha_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cancha = new Cancha();
        $cancha->setCreatedAt(new \DateTimeImmutable());
        $cancha->setUpdatedAt(new \DateTimeImmutable());
        $form = $this->createForm(CanchaType::class, $cancha);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cancha);
            $entityManager->flush();

            return $this->redirectToRoute('app_cancha_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cancha/new.html.twig', [
            'cancha' => $cancha,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cancha_show', methods: ['GET'])]
    public function show(Cancha $cancha): Response
    {
        return $this->render('cancha/show.html.twig', [
            'cancha' => $cancha,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cancha_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cancha $cancha, EntityManagerInterface $entityManager): Response
    {
        $cancha->setUpdatedAt(new \DateTimeImmutable());
        $form = $this->createForm(CanchaType::class, $cancha);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cancha_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cancha/edit.html.twig', [
            'cancha' => $cancha,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cancha_delete', methods: ['POST'])]
    public function delete(Request $request, Cancha $cancha, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cancha->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cancha);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cancha_index', [], Response::HTTP_SEE_OTHER);
    }
}
