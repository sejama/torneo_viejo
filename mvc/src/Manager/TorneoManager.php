<?php

namespace App\Manager;

use App\Repository\EquipoRepository;

class TorneoManager{
    public function __construct(
        private EquipoRepository $equipoRepository
    ) {
        
    }
    
    public function armadoZona(): array
    {   
        $equipos = $this->equipoRepository->findAll();
        foreach ($equipos as $equipo) {
                $categorias[$equipo->getZonaEquipo()->getZona()->getTorneoGeneroCategoria()->getGenero()->getNombre().''.$equipo->getZonaEquipo()->getZona()->getTorneoGeneroCategoria()->getCategoria()->getNombre()][$equipo->getZonaEquipo()->getZona()->getId()][] = $equipo;
        }
        return $categorias;
    }
}