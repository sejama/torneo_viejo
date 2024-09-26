<?php

namespace App\Controller;

use App\Entity\Torneo;
use App\Entity\TorneoGeneroCategoria;
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

    #[Route('/nuevo', name: 'app_torneo_nuevo', methods: ['GET', 'POST'])]
    public function nuevo(Request $request, EntityManagerInterface $entityManager): Response
    {

        if ( $request->isMethod('POST') ) {
            //var_dump($request->request->all('categorias'));die();
            $torneo = new Torneo();
            $torneo->setNombre($request->request->get('nombre'));
            $torneo->setDescripcion($request->request->get('descripcion'));
            $torneo->setFechaInicio(new \DateTimeImmutable($request->request->get('fechaInicio') . ' ' . $request->request->get('horaInicio')));
            $torneo->setFechaFin(new \DateTimeImmutable($request->request->get('fechaFin') . ' ' . $request->request->get('horaFin')));
            $torneo->setFechaInicioInscripcion(new \DateTimeImmutable($request->request->get('fechaInicioInscripcion') . ' ' . $request->request->get('horaInicioInscripcion')));
            $torneo->setFechaFinInscripcion(new \DateTimeImmutable($request->request->get('fechaFinInscripcion') . ' ' . $request->request->get('horaFinInscripcion')));
            $torneo->setCreatedAt(new \DateTimeImmutable());
            $torneo->setUpdatedAt(new \DateTimeImmutable());

            $arrayGenCat = $request->request->all('categorias');
            foreach ($arrayGenCat as $genCat) {
                $torneoCatGen = new TorneoGeneroCategoria();
                $torneoCatGen->setTorneo($torneo);
                $torneoCatGen->setCategoria($entityManager->getRepository('App\Entity\Categoria')->find((int)$genCat['categoria']));
                $torneoCatGen->setGenero($entityManager->getRepository('App\Entity\Genero')->find((int)$genCat['genero']));
                $torneoCatGen->setCreatedAt(new \DateTimeImmutable());
                $torneoCatGen->setUpdatedAt(new \DateTimeImmutable());
                $torneoCatGen->setCerrado(false);
                $torneoCatGen->setCreado(false);
                $entityManager->persist($torneoCatGen);
            }
            $torneoCatGen = new TorneoGeneroCategoria();
            $entityManager->persist($torneo);
            $entityManager->flush();
            return $this->redirectToRoute('app_torneo_index', [], Response::HTTP_SEE_OTHER);
        }else{
            $categorias = $entityManager->getRepository('App\Entity\Categoria')->findAll();
            $generos = $entityManager->getRepository('App\Entity\Genero')->findAll();
            return $this->render('torneo/nuevo.html.twig',[
                'categorias' => $categorias,
                'generos' => $generos
            ]);}
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
        $cantidadZonas = (int)$request->request->get('inputCantidad');
        $array = [];
        for ($i=0; $i < $cantidadZonas; $i++) { 
            $array[] = [
                'cantidadZona'.$i => (int)$request->request->get('inputCantidadEquiposZona'.$idTorneoGeneroCategoria.$i),
                'cantidadOro'.$i => (int)$request->request->get('inputOro'.$idTorneoGeneroCategoria.$i),
                'cantidadPlata'.$i => (int)$request->request->get('inputPlata'.$idTorneoGeneroCategoria.$i),
                'cantidadBronce'.$i => (int)$request->request->get('inputBronce'.$idTorneoGeneroCategoria.$i),
            ];
        }
        $tm->armadoFixture($idTorneoGeneroCategoria, $cantidadZonas, $array);

        return $this->redirectToRoute('app_main');
    }

    #[Route('/{id}/armarFixture/', name: 'app_torneo_armar_fixture', methods: ['POST'])]
    public function armarFixture(Request $request, TorneoManager $tm): Response
    {
            $idTorneoGeneroCategoria = (int)$request->get('id');
            $tm->armarPartidos($idTorneoGeneroCategoria);

            return $this->redirectToRoute('app_main');

    }
        
}
