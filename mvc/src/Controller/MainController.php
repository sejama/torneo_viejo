<?php

namespace App\Controller;

use App\Manager\TorneoManager;
use App\Repository\TorneoGeneroCategoriaRepository;
use App\Repository\TorneoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(TorneoRepository $tr, TorneoGeneroCategoriaRepository $tgcr, TorneoManager $tm): Response
    {
        $torneo = $tr->findAll() ? $tr->findAll()[0] : null; //$tr->find(4);
        $inscriptos = $tgcr->findBy(['torneo' => $torneo]);
        $zonas = $tm->armadoZona();
        return $this->render('main/index.html.twig', [
            'torneo' => $torneo,
            'inscriptos' => $inscriptos,
            'zonas' => $zonas
        ]);
    }
}
