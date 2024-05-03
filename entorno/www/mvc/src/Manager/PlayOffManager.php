<?php

namespace App\Manager;

use App\Entity\Cuartos;
use App\Entity\Fin;
use App\Entity\Partido;
use App\Entity\PlayOff;
use App\Entity\Semis;
use App\Entity\TerceroCuarto;
use App\Entity\TorneoGeneroCategoria;
use App\Entity\Triangular;
use App\Repository\CuartosRepository;
use App\Repository\EquipoRepository;
use App\Repository\FinRepository;
use App\Repository\PartidoRepository;
use App\Repository\PlayOffRepository;
use App\Repository\SemisRepository;
use App\Repository\TerceroCuartoRepository;
use App\Repository\TriangularRepository;

class PlayOffManager{
        private $equipoRepository;
        private $playOffRepository;
        private $cuartosRepository;
        private $semisRepository;
        private $finRepository;
        private $partidoRepository;
        private $triangularRepository;
        private $terceroCuartoRepository;

    public function __construct(
        EquipoRepository $equipoRepository,
        PlayOffRepository $playOffRepository,
        TriangularRepository $triangularRepository,
        CuartosRepository $cuartosRepository,
        SemisRepository $semisRepository,
        FinRepository $finRepository,
        PartidoRepository $partidoRepository,
        TerceroCuartoRepository $terceroCuartoRepository

    ){
        $this->equipoRepository = $equipoRepository;
        $this->playOffRepository = $playOffRepository;
        $this->cuartosRepository = $cuartosRepository;
        $this->semisRepository = $semisRepository;
        $this->finRepository = $finRepository;
        $this->partidoRepository = $partidoRepository;
        $this->triangularRepository = $triangularRepository;
        $this->terceroCuartoRepository = $terceroCuartoRepository;
    }
    
    public function armarPlayOff(
        TorneoGeneroCategoria $torneoGeneroCategoria, 
        bool $oro = false, 
        bool $plata = false, 
        bool $bronce = false,
        $equipos = [],
        bool $tercero = false,
        ){

        $playOff = $this->playOffRepository->findOneBy(['torneoGeneroCategoria' => $torneoGeneroCategoria, 'oro' => $oro, 'plata' => $plata, 'bronce' => $bronce]);
        if($playOff == null){
            $playOff = new PlayOff();
            $playOff->setTorneoGeneroCategoria($torneoGeneroCategoria);
            $playOff->setOro($oro);
            $playOff->setPlata($plata);
            $playOff->setBronce($bronce); 
        }

        
        $partidos = [];
        if(count($equipos) === 8){
            $cuartos = new Cuartos();
            $cuartos->setPlayOff($playOff);

            for($i = 0; $i < 8; $i++){
                $partido = new Partido();
                $partido->setEquipoLocal($this->equipoRepository->find((int)$equipos[$i++]));
                $partido->setEquipoVisitante($this->equipoRepository->find((int)$equipos[$i]));

                $partidos[] = $partido;
                
                $this->partidoRepository->savePartido($partido);
            }
            $cuartos->setPartido1($partidos[0]);
            $cuartos->setPartido2($partidos[1]);
            $cuartos->setPartido3($partidos[2]);
            $cuartos->setPartido4($partidos[3]);

            $this->cuartosRepository->saveCartos($cuartos);
        }

        if (count($equipos) == 4) {
            $semis = new Semis();
            $semis->setPlayOff($playOff);

            for($i = 0; $i < 4; $i++){
                $partido = new Partido();
                $partido->setEquipoLocal($this->equipoRepository->find((int)$equipos[$i++]));
                $partido->setEquipoVisitante($this->equipoRepository->find((int)$equipos[$i]));

                $partidos[] = $partido;

                $this->partidoRepository->savePartido($partido);
            }

            $semis->setPartido1($partidos[0]);
            $semis->setPartido2($partidos[1]);

            $this->semisRepository->saveSemis($semis);
        }

        if (count($equipos) == 3){
            $triangular = new Triangular();
            $triangular->setPlayOff($playOff);

            $partido1 = new Partido();
            $partido1->setEquipoLocal($this->equipoRepository->find((int)$equipos[0]));
            $partido1->setEquipoVisitante($this->equipoRepository->find((int)$equipos[1]));
            $this->partidoRepository->savePartido($partido1);

            $partido2 = new Partido();
            $partido2->setEquipoLocal($this->equipoRepository->find((int)$equipos[0]));
            $partido2->setEquipoVisitante($this->equipoRepository->find((int)$equipos[2]));
            $this->partidoRepository->savePartido($partido2);

            $partido3 = new Partido();
            $partido3->setEquipoLocal($this->equipoRepository->find((int)$equipos[1]));
            $partido3->setEquipoVisitante($this->equipoRepository->find((int)$equipos[2]));
            $this->partidoRepository->savePartido($partido3);

            $triangular->setPartido1($partido1);
            $triangular->setPartido2($partido2);
            $triangular->setPartido3($partido3);

            $this->triangularRepository->saveTriangular($triangular);
        }
        
        if (count($equipos) == 2) {
            if($tercero){
                $terceroCuarto = new TerceroCuarto();
                $terceroCuarto->setPlayOff($playOff);

                $partido = new Partido();
                $partido->setEquipoLocal($this->equipoRepository->find((int)$equipos[0]));
                $partido->setEquipoVisitante($this->equipoRepository->find((int)$equipos[1]));

                $terceroCuarto->setPartido1($partido);

                $this->partidoRepository->savePartido($partido);
                $this->terceroCuartoRepository->saveTerceroCuarto($terceroCuarto);
            }else{
                $fin = new Fin();
                $fin->setPlayOff($playOff);

                $partido = new Partido();
                $partido->setEquipoLocal($this->equipoRepository->find((int)$equipos[0]));
                $partido->setEquipoVisitante($this->equipoRepository->find((int)$equipos[1]));

                $fin->setPartido1($partido);

                $this->partidoRepository->savePartido($partido);
                $this->finRepository->saveFin($fin);
            }
        }

        $this->playOffRepository->savePlayOff($playOff);

    }

}