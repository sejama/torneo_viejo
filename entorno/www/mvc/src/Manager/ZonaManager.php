<?php

namespace App\Manager;

use App\Repository\ZonaRepository;

class ZonaManager{
    public function __construct(
        private ZonaRepository $zonaRepository,
    ) {
    }

    public function calcularPosicionesTodos(){
        $zonas = $this->zonaRepository->findAll();
        $posiciones = [];
        foreach ($zonas as $zona) {
            $posiciones[$zona->getId()] = $this->calcularPosiciones($zona->getId());
        }
        return $posiciones;
    }

    public function calcularPosiciones(int $idZona){
        $zona = $this->zonaRepository->find($idZona);
        $partidos = $zona->getPartidos();
        $posiciones = [];
        foreach ($partidos as $partido) {

            $local = $partido->getEquipoLocal();
            $localSet = [];
            $localSet[] = $partido->getLocalSet1() ?? 0;
            $localSet[] = $partido->getLocalSet2() ?? 0;
            $localSet[] = $partido->getLocalSet3() ?? 0;
            $localSet[] = $partido->getLocalSet4() ?? 0;
            $localSet[] = $partido->getLocalSet5() ?? 0;
        
            $visitante = $partido->getEquipoVisitante();
            $visitanteSet = [];
            $visitanteSet[] = $partido->getVisitanteSet1() ?? 0;
            $visitanteSet[] = $partido->getVisitanteSet2() ?? 0;
            $visitanteSet[] = $partido->getVisitanteSet3() ?? 0;
            $visitanteSet[] = $partido->getVisitanteSet4() ?? 0;
            $visitanteSet[] = $partido->getVisitanteSet5() ?? 0;

            $localPuntosFavor = $visitantePuntosContra = $localSet[0] + $localSet[1] + $localSet[2] + $localSet[3] + $localSet[4];
            $localPuntosContra = $visitantePuntosFavor = $visitanteSet[0] + $visitanteSet[1] + $visitanteSet[2] + $visitanteSet[3] + $visitanteSet[4];
            $localSetFavor = 0;
            $localSetContra = 0;

            // = $visitanteSet[0] + $visitanteSet[1] + $visitanteSet[2] + $visitanteSet[3] + $visitanteSet[4];
            // = $localSet[0] + $localSet[1] + $localSet[2] + $localSet[3] + $localSet[4];
            $visitanteSetFavor = 0;
            $visitanteSetContra = 0;


            if ($localPuntosFavor > 0 && $visitantePuntosFavor > 0) {
                for($i = 0; $i < 4; $i++){
                    if ($localSet[$i] != 0 || $visitanteSet[$i] != 0) {
                        if($localSet[$i] > $visitanteSet[$i]){
                            $localSetFavor++;
                            $visitanteSetContra++;
                        }else{
                            $visitanteSetFavor++;
                            $localSetContra++;
                        }
                    }
                }

                if ($localSetFavor > $visitanteSetFavor) {
                    $local->setPartidosGanados( $local->getPartidosGanados() + 1 );
                    $visitante->setPartidosPerdidos( $visitante->getPartidosPerdidos() + 1 );
                }else{
                    $visitante->setPartidosGanados( $visitante->getPartidosGanados() + 1 );
                    $local->setPartidosPerdidos( $local->getPartidosPerdidos() + 1 );
                }
                $local->setPartidosJugados( $local->getPartidosJugados() + 1 );

                $local->setSetsAFavor( $local->getSetsAFavor() + $localSetFavor );
                $local->setSetsEnContra( $local->getSetsEnContra() + $localSetContra );

                $local->setPuntosAFavor( $local->getPuntosAFavor() + $localPuntosFavor ) ;
                $local->setPuntosEnContra( $local->getPuntosEnContra() + $localPuntosContra );

                $visitante->setPartidosJugados( $visitante->getPartidosJugados() + 1 );

                $visitante->setSetsAFavor( $visitante->getSetsAFavor() + $visitanteSetFavor );
                $visitante->setSetsEnContra( $visitante->getSetsEnContra() + $visitanteSetContra );

                $visitante->setPuntosAFavor( $visitante->getPuntosAFavor() + $visitantePuntosFavor );
                $visitante->setPuntosEnContra( $visitante->getPuntosEnContra() + $visitantePuntosContra );

                $local->setPuntos( $local->getPartidosGanados() * 2 + $local->getPartidosPerdidos() );
                $visitante->setPuntos( $visitante->getPartidosGanados() * 2 + $visitante->getPartidosPerdidos() );
            }
            if (in_array($local, $posiciones)) {
                $posiciones[array_search($local, $posiciones)] = $local;
            }else{
                $posiciones[] = $local;
            }

            if (in_array($visitante, $posiciones)) {
                $posiciones[array_search($visitante, $posiciones)] = $visitante;
            }else{
                $posiciones[] = $visitante;
            }
        }

        return $this->ordenarPosiciones($posiciones);
    }

    private function ordenarPosiciones($posiciones){
        usort($posiciones, function($a, $b){
            if ($a->getPuntos() == $b->getPuntos()) {
                if ($a->getDiferenciaSets() == $b->getDiferenciaSets()) {
                    if ($a->getDiferenciaPuntos() == $b->getDiferenciaPuntos()) {
                        return 0;
                    }
                    return ($a->getDiferenciaPuntos() > $b->getDiferenciaPuntos()) ? -1 : 1;
                }
                return ($a->getDiferenciaSets() > $b->getDiferenciaSets()) ? -1 : 1;
            }
            return ($a->getPuntos() > $b->getPuntos()) ? -1 : 1;
        });
        return $posiciones;
    }
    
}