<?php

namespace App\Controller;

use App\Repository\TorneoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    #[Route('/', name: 'app_main')]
    public function index(TorneoRepository $tr): Response
    {
        $torneos = $tr->findAll();
        if (empty($torneos)) {
            $torneos = ['No hay torneos'];
        }
        return $this->render('main/index.html.twig', [
            'torneo' => $torneos[0],
        ]);
    }
}
