<?php

namespace App\Controller;

use App\Manager\TorneoManager;
use App\Manager\ZonaManager;
use App\Repository\PartidoRepository;
use App\Repository\TorneoGeneroCategoriaRepository;
use App\Repository\TorneoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(TorneoRepository $tr, TorneoGeneroCategoriaRepository $tgcr, TorneoManager $tm, ZonaManager $zm, PartidoRepository $pr): Response
    {
        $torneo = $tr->findAll() ? $tr->findAll()[0] : null; //$tr->find(4);
        $inscriptos = $tgcr->findBy(['torneo' => $torneo]);
        $zonas = $tm->armadoZona();
        $posiciones = $zm->calcularPosicionesTodos();
        $partidos = $pr->findAll();
        return $this->render('main/index.html.twig', [
            'torneo' => $torneo,
            'inscriptos' => $inscriptos,
            'zonas' => $zonas,
            'posiciones' => $posiciones,
            'partidos' => $partidos
        ]);
    }
}
