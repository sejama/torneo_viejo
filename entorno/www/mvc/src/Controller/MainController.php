<?php

namespace App\Controller;

use App\Manager\TorneoManager;
use App\Manager\ZonaManager;
use App\Repository\PartidoRepository;
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
        PartidoRepository $pr
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
        $partidos = $pr->findAll();
        return $this->render('main/index.html.twig', [
            'torneos' => $torneos,
            'torneoID' => $torneoID,
            'generos' => $generos,
            'generoID' => $generoID,
            'categorias' => $categorias,
            'categoriaID' => $categoriaID,
            'zonas' => $zonas,
            'posiciones' => $posiciones,
            'partidos' => $partidos
        ]);
    }
}
