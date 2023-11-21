<?php 

namespace App\Manager;

use App\Repository\EquipoRepository;

class ZonaManager{

    public function __construct(
        private EquipoRepository $equipoRepository
    ) {
        
    }
    
    public function armadoZona(): array
    {   
        $equipos = $this->equipoRepository->findAll();
        foreach ($equipos as $equipo) {
                $zonas[$equipo->getZonaEquipo()->getZona()->getId()][] = $equipo;
        }
        return $zonas;
    }
}