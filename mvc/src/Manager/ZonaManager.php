<?php

namespace App\Manager;

use App\Entity\Equipo;
use App\Entity\Zona;
use App\Repository\ZonaRepository;

class ZonaManager{
    public function __construct(
        private ZonaRepository $zonaRepository,
    ) {
    }

    public function calcularPosiciones(int $idZona){
        $zona = $this->zonaRepository->find($idZona);
        $partidos = $zona->getPartidos();
        $posiciones = [
            'equipos' => $equipo = null,
            'puntos' => 0,
            'partidosJugados' => 0,
            'partidosGanados' => 0,
            'partidosPerdidos' => 0,
            'setsAFavor' => 0,
            'setsEnContra' => 0,
            'diferenciaSets' => 0,
            'puntosAFavor' => 0,
            'puntosEnContra' => 0,
            'diferenciaPuntos' => 0,
        ];
        foreach ($partidos as $partido) {

            $local = $partido->getLocal();
            $localSet = [];
            $localSet[] = $partido->getLocalSet1() ?? 0;
            $localSet[] = $partido->getLocalSet2() ?? 0;
            $localSet[] = $partido->getLocalSet3() ?? 0;
            $localSet[] = $partido->getLocalSet4() ?? 0;
            $localSet[] = $partido->getLocalSet5() ?? 0;
        
            $visitante = $partido->getVisitante();
            $visitanteSet = [];
            $visitanteSet[] = $partido->getVisitanteSet1() ?? 0;
            $visitanteSet[] = $partido->getVisitanteSet2() ?? 0;
            $visitanteSet[] = $partido->getVisitanteSet3() ?? 0;
            $visitanteSet[] = $partido->getVisitanteSet4() ?? 0;
            $visitanteSet[] = $partido->getVisitanteSet5() ?? 0;

            $localPuntosFavor = $localSet[1] + $localSet[2] + $localSet[3] + $localSet[4] + $localSet[5];
            $localPuntosContra = $visitanteSet[1] + $visitanteSet[2] + $visitanteSet[3] + $visitanteSet[4] + $visitanteSet[5];
            $localSetFavor = 0;
            $localSetContra = 0;

            $visitantePuntosFavor = $visitanteSet[1] + $visitanteSet[2] + $visitanteSet[3] + $visitanteSet[4] + $visitanteSet[5];
            $visitantePuntosContra = $localSet[1] + $localSet[2] + $localSet[3] + $localSet[4] + $localSet[5];
            $visitanteSetFavor = 0;
            $visitanteSetContra = 0;

            for($i = 0; $i < 5; $i++){
                if($localSet[$i] > $visitanteSet[$i]){
                    $localSetFavor++;
                    $visitanteSetContra++;
                }else{
                    $visitanteSetFavor++;
                    $localSetContra++;
                }
            }



            
        }
    }
}