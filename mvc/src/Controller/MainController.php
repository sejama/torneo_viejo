<?php

namespace App\Controller;

use App\Repository\TorneoGeneroCategoriaRepository;
use App\Repository\TorneoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    #[Route('/', name: 'app_main')]
    public function index(TorneoRepository $tr, TorneoGeneroCategoriaRepository $tgcr): Response
    {
        $torneo = $tr->findAll()[1]; //$tr->find(4);
        $inscriptos = $tgcr->findBy(['torneo' => $torneo]);
        return $this->render('main/index.html.twig', [
            'torneo' => $torneo,
            'inscriptos' => $inscriptos,
        ]);
    }
}
