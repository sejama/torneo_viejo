<?php

namespace App\Controller;


use App\Manager\TorneoManager;
use App\Manager\ZonaManager;
use App\Repository\PartidoRepository;
use App\Repository\TorneoGeneroCategoriaRepository;
use App\Repository\ZonaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main', methods: ['GET', 'POST'])]
    public function index(
        Request $request,
        TorneoManager $tm, 
        ZonaManager $zm,
        PartidoRepository $pr,
        TorneoGeneroCategoriaRepository $tgcr,
        ZonaRepository $zr
    ): Response
    {   
        $torneoID = null;
        $generoID = null;
        $categoriaID = null;
        if ($request->isMethod('POST')) {
            $torneoID = $request->request->get('selectTorneo') != "" ? (int)$request->request->get('selectTorneo') : null;
            $generoID = $request->request->get('selectGenero') != "" ? (int)$request->request->get('selectGenero') : null;
            $categoriaID = $request->request->get('selectCategoria') != "" ? (int)$request->request->get('selectCategoria') : null;
            $zonas = $tm->getZonas($torneoID, $generoID, $categoriaID);
        }else{
            $zonas = $tm->getZonas(null, null, null);
        }
        $torneos = $tm->getTorneos();
        $generos = $tm->getGeneros();
        $categorias = $tm->getCategorias();
        $posiciones = $zm->calcularPosicionesTodos();
        $partidos = $pr->findBy([], ['horario' => 'ASC']);
        $tgcs = $tgcr->findAll();
        $playOffs = $tm->getPlayOffAll();
        $zonaNombre = $zr->findAll();
        return $this->render('main/index.html.twig', [
            'torneos' => $torneos,
            'torneoID' => $torneoID,
            'generos' => $generos,
            'generoID' => $generoID,
            'categorias' => $categorias,
            'categoriaID' => $categoriaID,
            'zonas' => $zonas,
            'zonaNombre' => $zonaNombre,
            'posiciones' => $posiciones,
            'partidos' => $partidos,
            'tgcs' => $tgcs,
            'playOffs' => $playOffs
        ]);
    }

    #[Route('/reglamento', name: 'app_main_reglamento', methods: ['GET'])]
    public function reglamento(): Response
    {
        return $this->render('main/reglamento/reglamento.html.twig');
    }

    #[Route('/fixture', name: 'app_main_fixture', methods: ['GET'])]
    public function fixture(
        PartidoRepository $pr,
    ): Response
    {
        $partidos = $pr->findBy([], ['horario' => 'ASC']);
        return $this->render('main/fixture/fixture.html.twig',['partidos' => $partidos]);
    }
}
