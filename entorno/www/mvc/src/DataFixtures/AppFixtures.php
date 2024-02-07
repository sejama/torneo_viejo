<?php

namespace App\DataFixtures;

use App\Entity\Categoria;
use App\Entity\Equipo;
use App\Entity\Genero;
use App\Entity\Torneo;
use App\Entity\TorneoGeneroCategoria;
use App\Entity\User;
use App\Entity\Zona;
use App\Entity\ZonaEquipo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasherInterface;

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface) 
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {   
        $user = new User();
        $user->setUsername('admin');
        $user->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $user, "admin"
            )
        );
        $manager->persist($user);

        $torneo = new Torneo();
        $torneo->setNombre('Torneo de prueba');
        $torneo->setDescripcion('Descripcion torneo de prueba');
        $torneo->setFechaInicio(new \DateTimeImmutable('2024-01-01 09:00:00'));
        $torneo->setFechaFin(new \DateTimeImmutable('2024-01-31 20:00:00'));
        $torneo->setFechaInicioInscripcion(new \DateTimeImmutable('2020-12-01'));
        $torneo->setFechaFinInscripcion(new \DateTimeImmutable('2023-12-31 23:59:59'));
        $torneo->setCreatedAt(new \DateTimeImmutable('now'));
        $torneo->setUpdatedAt(new \DateTimeImmutable('now'));
        $manager->persist($torneo);

        $femenino = new Genero();
        $femenino->setNombre('Femenino');
        $femenino->setCreatedAt(new \DateTimeImmutable('now'));
        $femenino->setUpdatedAt(new \DateTimeImmutable('now'));
        $manager->persist($femenino);

        $masculino = new Genero();
        $masculino->setNombre('Masculino');
        $masculino->setCreatedAt(new \DateTimeImmutable('now'));
        $masculino->setUpdatedAt(new \DateTimeImmutable('now'));
        $manager->persist($masculino);

        $cat30 = new Categoria();
        $cat30->setNombre('+30');
        $cat30->setDescripcion('Categoría mayores de 30 años');
        $cat30->setCreatedAt(new \DateTimeImmutable('now'));
        $cat30->setUpdatedAt(new \DateTimeImmutable('now'));
        $manager->persist($cat30);

        $cat35 = new Categoria();
        $cat35->setNombre('+35');
        $cat35->setDescripcion('Categoría mayores de 35 años');
        $cat35->setCreatedAt(new \DateTimeImmutable('now'));
        $cat35->setUpdatedAt(new \DateTimeImmutable('now'));
        $manager->persist($cat35);

        $cat42 = new Categoria();
        $cat42->setNombre('+42');
        $cat42->setDescripcion('Categoría mayores de 42 años');
        $cat42->setCreatedAt(new \DateTimeImmutable('now'));
        $cat42->setUpdatedAt(new \DateTimeImmutable('now'));
        $manager->persist($cat42);

        $cat50 = new Categoria();
        $cat50->setNombre('+50');
        $cat50->setDescripcion('Categoría mayores de 50 años');
        $cat50->setCreatedAt(new \DateTimeImmutable('now'));
        $cat50->setUpdatedAt(new \DateTimeImmutable('now'));
        $manager->persist($cat50);

        $tgcf30 = new TorneoGeneroCategoria();
        $tgcf30->setTorneo($torneo);
        $tgcf30->setGenero($femenino);
        $tgcf30->setCategoria($cat30);
        $tgcf30->setCreatedAt(new \DateTimeImmutable('now'));
        $tgcf30->setUpdatedAt(new \DateTimeImmutable('now'));
        $manager->persist($tgcf30);

        $tgcf35 = new TorneoGeneroCategoria();
        $tgcf35->setTorneo($torneo);
        $tgcf35->setGenero($femenino);
        $tgcf35->setCategoria($cat35);
        $tgcf35->setCreatedAt(new \DateTimeImmutable('now'));
        $tgcf35->setUpdatedAt(new \DateTimeImmutable('now'));
        $manager->persist($tgcf35);

        $tgcf42 = new TorneoGeneroCategoria();
        $tgcf42->setTorneo($torneo);
        $tgcf42->setGenero($femenino);
        $tgcf42->setCategoria($cat42);
        $tgcf42->setCreatedAt(new \DateTimeImmutable('now'));
        $tgcf42->setUpdatedAt(new \DateTimeImmutable('now'));
        $manager->persist($tgcf42);

        $tgcm35 = new TorneoGeneroCategoria();
        $tgcm35->setTorneo($torneo);
        $tgcm35->setGenero($masculino);
        $tgcm35->setCategoria($cat35);
        $tgcm35->setCreatedAt(new \DateTimeImmutable('now'));
        $tgcm35->setUpdatedAt(new \DateTimeImmutable('now'));
        $manager->persist($tgcm35);

        $tgcm42 = new TorneoGeneroCategoria();
        $tgcm42->setTorneo($torneo);
        $tgcm42->setGenero($masculino);
        $tgcm42->setCategoria($cat42);
        $tgcm42->setCreatedAt(new \DateTimeImmutable('now'));
        $tgcm42->setUpdatedAt(new \DateTimeImmutable('now'));
        $manager->persist($tgcm42);

        $tgcm50 = new TorneoGeneroCategoria();
        $tgcm50->setTorneo($torneo);
        $tgcm50->setGenero($masculino);
        $tgcm50->setCategoria($cat50);
        $tgcm50->setCreatedAt(new \DateTimeImmutable('now'));
        $tgcm50->setUpdatedAt(new \DateTimeImmutable('now'));
        $manager->persist($tgcm50);

        /*$zonaf301 = new Zona();
        $zonaf301->setTorneoGeneroCategoria($tgcf30);
        $manager->persist($zonaf301);

        $zonaf302 = new Zona();
        $zonaf302->setTorneoGeneroCategoria($tgcf30);
        $manager->persist($zonaf302);*/

        //$f30s = ['INFINITO','CSDC CORRRIENTES','LA EMILIA','EL QUILLA','FUNDACION CORRIENTES','LA MILONETA','ALIANZA SANTOTO','MAMIS RESISTENCIA'];
        $f30s1 = ['INFINITO','CSDC CORRRIENTES','LA EMILIA','EL QUILLA'];
        $f30s2 = ['FUNDACION CORRIENTES','LA MILONETA','ALIANZA SANTOTO','MAMIS RESISTENCIA'];
        
        foreach($f30s1 as $f30) {
            $equipo = new Equipo();
            $equipo->setNombre($f30);
            $equipo->setTorneoGeneroCategoria($tgcf30);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));

            $manager->persist($equipo);
            
            /*$zonaEquipo = new ZonaEquipo();
            $zonaEquipo->setZona($zonaf301);
            $zonaEquipo->setEquipo($equipo);
            $manager->persist($zonaEquipo);*/
        }

        foreach($f30s2 as $f30) {
            $equipo = new Equipo();
            $equipo->setNombre($f30);
            $equipo->setTorneoGeneroCategoria($tgcf30);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);
            
            /*$zonaEquipo = new ZonaEquipo();
            $zonaEquipo->setZona($zonaf302);
            $zonaEquipo->setEquipo($equipo);
            $manager->persist($zonaEquipo);*/
        }

        /*$zonaf3515 = new Zona();
        $zonaf3515->setTorneoGeneroCategoria($tgcf35);
        $manager->persist($zonaf3515);

        $zonaf3525 = new Zona();
        $zonaf3525->setTorneoGeneroCategoria($tgcf35);
        $manager->persist($zonaf3525);

        $zonaf3534 = new Zona();
        $zonaf3534->setTorneoGeneroCategoria($tgcf35);
        $manager->persist($zonaf3534);

        $zonaf3544 = new Zona();
        $zonaf3544->setTorneoGeneroCategoria($tgcf35);
        $manager->persist($zonaf3544);*/

        //$f35s = ['REGATAS','MALUCA','LAS BRUJAS','LAS CUERVAS','EL QUILLA','VILLA DORA','MALA MIA','LAS VIRGI','OVJ PAISANDU','APA','ADELANTE','LAS GOLOS','SOC SPORT ROLDAN','ON FIRE','NAUTICO AVELLANEDA','AQUELARRE URUGUAY','TREDE/BIRRA','MONSTARD'];
        $f35s1 = ['REGATAS','MALUCA','LAS BRUJAS','LAS CUERVAS','EL QUILLA'];
        $f35s2 = ['VILLA DORA','MALA MIA','LAS VIRGI','OVJ PAISANDU','APA'];
        $f35s3 = ['ADELANTE','LAS GOLOS','SOC SPORT ROLDAN','ON FIRE'];
        $f35s4 = ['NAUTICO AVELLANEDA','AQUELARRE URUGUAY','TREDE/BIRRA','MONSTARD'];
        foreach ($f35s1 as $f35) {
            $equipo = new Equipo();
            $equipo->setNombre($f35);
            $equipo->setTorneoGeneroCategoria($tgcf35);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);

            /*$zonaEquipo = new ZonaEquipo();
            $zonaEquipo->setZona($zonaf3515);
            $zonaEquipo->setEquipo($equipo);
            $manager->persist($zonaEquipo);*/
        }

        foreach ($f35s2 as $f35) {
            $equipo = new Equipo();
            $equipo->setNombre($f35);
            $equipo->setTorneoGeneroCategoria($tgcf35);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);

            /*$zonaEquipo = new ZonaEquipo();
            $zonaEquipo->setZona($zonaf3525);
            $zonaEquipo->setEquipo($equipo);
            $manager->persist($zonaEquipo);*/
        }

        foreach ($f35s3 as $f35) {
            $equipo = new Equipo();
            $equipo->setNombre($f35);
            $equipo->setTorneoGeneroCategoria($tgcf35);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);

            /*$zonaEquipo = new ZonaEquipo();
            $zonaEquipo->setZona($zonaf3534);
            $zonaEquipo->setEquipo($equipo);
            $manager->persist($zonaEquipo);*/
        }

        foreach ($f35s4 as $f35) {
            $equipo = new Equipo();
            $equipo->setNombre($f35);
            $equipo->setTorneoGeneroCategoria($tgcf35);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);

            /*$zonaEquipo = new ZonaEquipo();
            $zonaEquipo->setZona($zonaf3544);
            $zonaEquipo->setEquipo($equipo);
            $manager->persist($zonaEquipo);*/
        }

        /*$zonaf421 = new Zona();
        $zonaf421->setTorneoGeneroCategoria($tgcf42);
        $manager->persist($zonaf421);

        $zonaf422 = new Zona();
        $zonaf422->setTorneoGeneroCategoria($tgcf42);
        $manager->persist($zonaf422);

        $zonaf423 = new Zona();
        $zonaf423->setTorneoGeneroCategoria($tgcf42);
        $manager->persist($zonaf423);

        $zonaf424 = new Zona();
        $zonaf424->setTorneoGeneroCategoria($tgcf42);
        $manager->persist($zonaf424);

        $zonaf425 = new Zona();
        $zonaf425->setTorneoGeneroCategoria($tgcf42);
        $manager->persist($zonaf425);

        $zonaf426 = new Zona();
        $zonaf426->setTorneoGeneroCategoria($tgcf42);
        $manager->persist($zonaf426);*/

        //$f42s = ['MALUCA','SF ALTO VOLEY','INFINITO','VOLEY MONTE','MALA MIA','LAS VIEJA DE TATI','CTRO REC SGO ESTERO','MICUMAN','LAS GOLOS','CANARIAS','AMIGAS POR EL VOLEY','LAS BRANCAS','MONSTARD','COSTA MIX','GUEMES SALTA','12 REINAS','BISARRAS','LAS FENIX','GYE E.R.','EL REJUNTE','LA MADRID','UNI SF','KUÑA','PANSAS VERDES'];
        $f42s1 = ['MALUCA','SF ALTO VOLEY','INFINITO','VOLEY MONTE'];
        $f42s2 = ['MALA MIA','LAS VIEJA DE TATI','CTRO REC SGO ESTERO','MICUMAN'];
        $f42s3 = ['LAS GOLOS','CANARIAS','AMIGAS POR EL VOLEY','LAS BRANCAS'];
        $f42s4 = ['MONSTARD','COSTA MIX','GUEMES SALTA','12 REINAS'];
        $f42s5 = ['BISARRAS','LAS FENIX','GYE E.R.','EL REJUNTE'];
        $f42s6 = ['LA MADRID','UNI SF','KUÑA','PANSAS VERDES'];

        foreach ($f42s1 as $f42) {
            $equipo = new Equipo();
            $equipo->setNombre($f42);
            $equipo->setTorneoGeneroCategoria($tgcf42);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);

            /*$zonaEquipo = new ZonaEquipo();
            $zonaEquipo->setZona($zonaf421);
            $zonaEquipo->setEquipo($equipo);
            $manager->persist($zonaEquipo);*/
        }

        foreach ($f42s2 as $f42) {
            $equipo = new Equipo();
            $equipo->setNombre($f42);
            $equipo->setTorneoGeneroCategoria($tgcf42);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);

            /*$zonaEquipo = new ZonaEquipo();
            $zonaEquipo->setZona($zonaf422);
            $zonaEquipo->setEquipo($equipo);
            $manager->persist($zonaEquipo);*/
        }

        foreach ($f42s3 as $f42) {
            $equipo = new Equipo();
            $equipo->setNombre($f42);
            $equipo->setTorneoGeneroCategoria($tgcf42);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);

            /*$zonaEquipo = new ZonaEquipo();
            $zonaEquipo->setZona($zonaf423);
            $zonaEquipo->setEquipo($equipo);
            $manager->persist($zonaEquipo);*/
        }

        foreach ($f42s4 as $f42) {
            $equipo = new Equipo();
            $equipo->setNombre($f42);
            $equipo->setTorneoGeneroCategoria($tgcf42);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);
            
            /*$zonaEquipo = new ZonaEquipo();
            $zonaEquipo->setZona($zonaf424);
            $zonaEquipo->setEquipo($equipo);
            $manager->persist($zonaEquipo);*/
        }

        foreach ($f42s5 as $f42) {
            $equipo = new Equipo();
            $equipo->setNombre($f42);
            $equipo->setTorneoGeneroCategoria($tgcf42);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);
            
            /*$zonaEquipo = new ZonaEquipo();
            $zonaEquipo->setZona($zonaf425);
            $zonaEquipo->setEquipo($equipo);
            $manager->persist($zonaEquipo);*/
        }

        foreach ($f42s6 as $f42) {
            $equipo = new Equipo();
            $equipo->setNombre($f42);
            $equipo->setTorneoGeneroCategoria($tgcf42);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);
            
            /*$zonaEquipo = new ZonaEquipo();
            $zonaEquipo->setZona($zonaf426);
            $zonaEquipo->setEquipo($equipo);
            $manager->persist($zonaEquipo);*/
        }

        /*$zonam35 = new Zona();
        $zonam35->setTorneoGeneroCategoria($tgcm35);
        $manager->persist($zonam35);*/

        $m35s = ['BOLA 8','LA GARRA','RACING RECONQUISTA','DESPELOTE','ROMANG FUTBOL CLUB','CLUB DE AMIGOS'];
        foreach ($m35s as $m35) {
            $equipo = new Equipo();
            $equipo->setNombre($m35);
            $equipo->setTorneoGeneroCategoria($tgcm35);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);

            /*$zonaEquipo = new ZonaEquipo();
            $zonaEquipo->setZona($zonam35);
            $zonaEquipo->setEquipo($equipo);
            $manager->persist($zonaEquipo);*/
        }

        /*$zonam421 = new Zona();
        $zonam421->setTorneoGeneroCategoria($tgcm42);
        $manager->persist($zonam421);

        $zonam422 = new Zona();
        $zonam422->setTorneoGeneroCategoria($tgcm42);
        $manager->persist($zonam422);*/

        //$m42s = ['MAXI SANTA FE','PAYSANDU','HAVANNA','DEF MORENO','NO PASA NARANJA','ROSARIO VOLEY','BANCO PROVINCIA','LA TRIBU'];
        $m42s1 = ['MAXI SANTA FE','PAYSANDU','HAVANNA','DEF MORENO'];
        $m42s2 = ['NO PASA NARANJA','ROSARIO VOLEY','BANCO PROVINCIA','LA TRIBU'];
        foreach ($m42s1 as $m42) {
            $equipo = new Equipo();
            $equipo->setNombre($m42);
            $equipo->setTorneoGeneroCategoria($tgcm42);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);

            /*$zonaEquipo = new ZonaEquipo();
            $zonaEquipo->setZona($zonam421);
            $zonaEquipo->setEquipo($equipo);
            $manager->persist($zonaEquipo);*/
        }

        foreach ($m42s2 as $m42) {
            $equipo = new Equipo();
            $equipo->setNombre($m42);
            $equipo->setTorneoGeneroCategoria($tgcm42);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);
            
            /*$zonaEquipo = new ZonaEquipo();
            $zonaEquipo->setZona($zonam422);
            $zonaEquipo->setEquipo($equipo);
            $manager->persist($zonaEquipo);*/
        }

        /*$zonam501 = new Zona();
        $zonam501->setTorneoGeneroCategoria($tgcm50);
        $manager->persist($zonam501);

        $zonam502 = new Zona();
        $zonam502->setTorneoGeneroCategoria($tgcm50);
        $manager->persist($zonam502);*/

        //$m50s = ['TACUAREMBO','TUCUMAN DE GIMNASIA','LOS PERKIN','DEF MORENO','BANCO HISPANO','UNI SJ','LPV','LA TRIBU','RIO CUARTO','ALGO DISTINTO'];
        $m50s1 = ['TACUAREMBO','TUCUMAN DE GIMNASIA','LOS PERKIN','DEF MORENO','BANCO HISPANO'];
        $m50s2 = ['UNI SJ','LPV','LA TRIBU','RIO CUARTO','ALGO DISTINTO'];

        foreach ($m50s1 as $m50) {
            $equipo = new Equipo();
            $equipo->setNombre($m50);
            $equipo->setTorneoGeneroCategoria($tgcm50);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);

            /*$zonaEquipo = new ZonaEquipo();
            $zonaEquipo->setZona($zonam501);
            $zonaEquipo->setEquipo($equipo);
            $manager->persist($zonaEquipo);*/
        }

        foreach ($m50s2 as $m50) {
            $equipo = new Equipo();
            $equipo->setNombre($m50);
            $equipo->setTorneoGeneroCategoria($tgcm50);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);
            
            /*$zonaEquipo = new ZonaEquipo();
            $zonaEquipo->setZona($zonam502);
            $zonaEquipo->setEquipo($equipo);
            $manager->persist($zonaEquipo);*/
        }

        $manager->flush();
    }
}
