<?php

namespace App\Manager;

use App\Entity\Partido;
use App\Entity\Zona;
use App\Entity\ZonaEquipo;
use App\Repository\CategoriaRepository;
use App\Repository\EquipoRepository;
use App\Repository\GeneroRepository;
use App\Repository\PartidoRepository;
use App\Repository\TorneoGeneroCategoriaRepository;
use App\Repository\TorneoRepository;
use App\Repository\ZonaEquipoRepository;
use App\Repository\ZonaRepository;

class TorneoManager{
    public function __construct(
        private TorneoRepository $torneoRepository,
        private EquipoRepository $equipoRepository,
        private ZonaRepository $zonaRepository,
        private ZonaEquipoRepository $zonaEquipoRepository,
        private TorneoGeneroCategoriaRepository $torneoGeneroCategoriaRepository,
        private PartidoRepository $partidoRepository,
        private GeneroRepository $generoRepository,
        private CategoriaRepository $categoriaRepository

    ) {
        
    }

    public function getTorneos(): array
    {
        return $this->torneoRepository->findAll();
    }

    public function getGeneros(): array
    {
        return $this->generoRepository->findAll();
    }

    public function getCategorias(): array
    {
        return $this->categoriaRepository->findAll();
    }

    public function getZonas(?int $torneoId, ?int $generoId, ?int $categoriaId ): array
    {
        $equipos = $this->equipoRepository->findAll();
        $categorias = [];
        foreach ($equipos as $equipo) {
            if ($equipo->getZonaEquipo())
            {
                if (
                    $equipo->getZonaEquipo()->getZona()->getTorneoGeneroCategoria()->getTorneo()->getId() === $torneoId && 
                    $equipo->getZonaEquipo()->getZona()->getTorneoGeneroCategoria()->getGenero()->getId() === $generoId && 
                    $equipo->getZonaEquipo()->getZona()->getTorneoGeneroCategoria()->getCategoria()->getId() === $categoriaId)
                {
                    $categorias[$equipo->getZonaEquipo()->getZona()->getTorneoGeneroCategoria()->getGenero()->getNombre().''.$equipo->getZonaEquipo()->getZona()->getTorneoGeneroCategoria()->getCategoria()->getNombre()][$equipo->getZonaEquipo()->getZona()->getId()][] = $equipo;
                }
            }
        }

        return $categorias;
    }

    public function armadoFixture(int $idTorneoGeneroCategoria, int $cantidadZonas, $array ): void
    {   
        $torneoGeneroCategoria = null;
        $equipos = $this->equipoRepository->findAll();
        foreach ($equipos as $equipo) {
            if ($equipo->getTorneoGeneroCategoria()->getId() === $idTorneoGeneroCategoria )
            {   
                $torneoGeneroCategoria = $equipo->getTorneoGeneroCategoria();
                $equiposZona[] = $equipo;
            }
        }
        if ($torneoGeneroCategoria->isCerrado()) {
            return;
        }
        $id = 0;
        for ($i=0; $i < $cantidadZonas; $i++) { 
            $zona = new Zona();
            $zona->setTorneoGeneroCategoria($torneoGeneroCategoria);
            $zona->setClasificanOro($array[$i]['cantidadOro'.$i]);
            $zona->setClasificanPlata($array[$i]['cantidadPlata'.$i]);
            $zona->setClasificanBronce($array[$i]['cantidadBronce'.$i]);
            $this->zonaRepository->guardarZona($zona);
            for ($j=0; $j < $array[$i]['cantidadZona'.$i]; $j++) { 
                $zonaEquipo = new ZonaEquipo();
                $zonaEquipo->setZona($zona);
                $zonaEquipo->setEquipo($equiposZona[$id++]);
                $this->zonaEquipoRepository->guardarZonaEquipo($zonaEquipo);
            }
        }
        $this->torneoGeneroCategoriaRepository->actualizarTGC($torneoGeneroCategoria->setCerrado(true));
    }

    public function armarPartidos(int $id): void
    {
        $torneoGeneroCategoria = $this->torneoGeneroCategoriaRepository->find($id);
        if ($torneoGeneroCategoria->isCreado()) {
            return;
        }
        $zonas = $this->zonaRepository->findBy(['torneoGeneroCategoria' => $id]);
        foreach ($zonas as $zona) {
            $equipos = $this->zonaEquipoRepository->findBy(['zona' => $zona->getId()]);
            for ($i=0; $i < count($equipos); $i++) {
                for ($j=$i+1; $j < count($equipos); $j++) { 
                    $partido = new Partido();
                    $partido->setZona($zona);
                    $partido->setEquipoLocal($equipos[$i]->getEquipo());
                    $partido->setEquipoVisitante($equipos[$j]->getEquipo());
                    $this->partidoRepository->savePartido($partido);
                    
                }
            }
        }
        $this->torneoGeneroCategoriaRepository->actualizarTGC($torneoGeneroCategoria->setCreado(true));
    }

    public function getPlayOffAll(): array
    {
        $playOffs = [];
        
        $tgcs = $this->torneoGeneroCategoriaRepository->findAll();

        foreach ($tgcs as $tgc) {
            $playOffsAll = $tgc->getPlayOffs();
            foreach ($playOffsAll as $playOff) {
                if($playOff->isOro()){
                    $playOffs[] = [
                        'torneo' => $playOff->getTorneoGeneroCategoria()->getTorneo()->getId(),
                        'genero' => $playOff->getTorneoGeneroCategoria()->getGenero()->getId(),
                        'categoria' => $playOff->getTorneoGeneroCategoria()->getCategoria()->getId(),
                        'oro' => $playOff->isOro(),
                        'plata' => $playOff->isPlata(),
                        'bronce' => $playOff->isBronce(),
                        'cuartos' => $playOff->getCuartos(),
                        'semis' => $playOff->getSemis(),
                        'final' => $playOff->getFin()
                    ];
                }
            }
            foreach ($playOffsAll as $playOff) {
                if($playOff->isPlata()){
                    $playOffs[] = [
                        'torneo' => $playOff->getTorneoGeneroCategoria()->getTorneo()->getId(),
                        'genero' => $playOff->getTorneoGeneroCategoria()->getGenero()->getId(),
                        'categoria' => $playOff->getTorneoGeneroCategoria()->getCategoria()->getId(),
                        'oro' => $playOff->isOro(),
                        'plata' => $playOff->isPlata(),
                        'bronce' => $playOff->isBronce(),
                        'cuartos' => $playOff->getCuartos(),
                        'semis' => $playOff->getSemis(),
                        'final' => $playOff->getFin()
                    ];
                }
            }
            foreach ($playOffsAll as $playOff) {
                if($playOff->isBronce()){
                    $playOffs[] = [
                        'torneo' => $playOff->getTorneoGeneroCategoria()->getTorneo()->getId(),
                        'genero' => $playOff->getTorneoGeneroCategoria()->getGenero()->getId(),
                        'categoria' => $playOff->getTorneoGeneroCategoria()->getCategoria()->getId(),
                        'oro' => $playOff->isOro(),
                        'plata' => $playOff->isPlata(),
                        'bronce' => $playOff->isBronce(),
                        'cuartos' => $playOff->getCuartos(),
                        'semis' => $playOff->getSemis(),
                        'final' => $playOff->getFin()
                    ];
                }
            }
        }

        return $playOffs;
    }
}