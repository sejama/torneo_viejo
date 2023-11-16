<?php

namespace App\DataFixtures;

use App\Entity\Categoria;
use App\Entity\Equipo;
use App\Entity\Genero;
use App\Entity\Torneo;
use App\Entity\TorneoGeneroCategoria;
use App\Entity\User;
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
        $torneo->setFechaInicio(new \DateTimeImmutable('2024-01-01'));
        $torneo->setFechaFin(new \DateTimeImmutable('2024-01-31'));
        $torneo->setFechaInicioInscripcion(new \DateTimeImmutable('2020-12-01'));
        $torneo->setFechaFinInscripcion(new \DateTimeImmutable('2020-12-31'));
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

        $f30s = ['EL QUILLA','LA EMILIA','CSDC CORRRIENTES','INFINITO','ALIANZA SANTOTO','LA MILONETA','FUNDACION CORRIENTES','MAMIS RESISTENCIA'];
        foreach($f30s as $f30) {
            $equipo = new Equipo();
            $equipo->setNombre($f30);
            $equipo->setTorneoGeneroCategoria($tgcf30);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);
        }

        $f35s = ['REGATAS','MALUCA','LAS BRUJAS','LAS CUERVAS','EL QUILLA','VILLA DORA','MALA MIA','LAS VIRGI','OVJ PAISANDU','APA','ADELANTE','LAS GOLOS','SOC SPORT ROLDAN','ON FIRE','NAUTICO AVELLANEDA','AQUELARRE URUGUAY','TREDE/BIRRA','MONSTARD'];
        foreach ($f35s as $f35) {
            $equipo = new Equipo();
            $equipo->setNombre($f35);
            $equipo->setTorneoGeneroCategoria($tgcf35);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);
        }

        $f42s = ['MALUCA','MALA MIA','LAS GOLOS','MONSTARD','BISARRAS','LA MADRID','SF ALTO VOLEY','LAS VIEJA DE TATI','CANARIAS','COSTA MIX','LAS FENIX','UNI SF','INFINITO','CTRO REC SGO ESTERO','AMIGAS POR EL VOLEY','GUEMES SALTA','GYE E.R.','KUÑA','VOLEY MONTE','MICUMAN','LAS BRANCAS','12 REINAS','EL REJUNTE','PANSAS VERDES'];
        foreach ($f42s as $f42) {
            $equipo = new Equipo();
            $equipo->setNombre($f42);
            $equipo->setTorneoGeneroCategoria($tgcf42);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);
        }

        $m35s = ['BOLA 8','LA GARRA','RACING RECONQUISTA','DESPELOTE','ROMANG FUTBOL CLUB','CLUB DE AMIGOS'];
        foreach ($m35s as $m35) {
            $equipo = new Equipo();
            $equipo->setNombre($m35);
            $equipo->setTorneoGeneroCategoria($tgcm35);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);
        }

        $m42s = ['MAXI SANTA FE','NO PASA NARANJA','PAYSANDU','ROSARIO VOLEY','HAVANNA','BANCO PROVINCIA','DEF MORENO','LA TRIBU'];
        foreach ($m42s as $m42) {
            $equipo = new Equipo();
            $equipo->setNombre($m42);
            $equipo->setTorneoGeneroCategoria($tgcm42);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);
        }

        $m50s = ['TACUAREMBO','UNI SJ','TUCUMAN DE GIMNASIA','LPV','LOS PERKIN','LA TRIBU','DEF MORENO','RIO CUARTO','BANCO HISPANO','ALGO DISTINTO'];
        foreach ($m50s as $m50) {
            $equipo = new Equipo();
            $equipo->setNombre($m50);
            $equipo->setTorneoGeneroCategoria($tgcm50);
            $equipo->setCreatedAt(new \DateTimeImmutable('now'));
            $equipo->setUpdatedAt(new \DateTimeImmutable('now'));
            $manager->persist($equipo);
        }

        $manager->flush();
    }
}
