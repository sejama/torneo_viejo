<?php

namespace App\DataFixtures;

use App\Entity\Categoria;
use App\Entity\Genero;
use App\Entity\Torneo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $torneo = new Torneo();
        $torneo->setNombre('Torneo de prueba');
        $torneo->setFechaInicio(new \DateTimeImmutable('2021-10-01'));
        $torneo->setFechaFin(new \DateTimeImmutable('2021-12-01'));
        $torneo->setFechaInicioInscripcion(new \DateTimeImmutable('2021-09-30'));
        $torneo->setFechaFinInscripcion(new \DateTimeImmutable('2021-10-01'));

        $masculino = new Genero();
        $masculino->setNombre('Masculino');

        $femenino = new Genero();
        $femenino->setNombre('Femenino');

        $mas30 = new Categoria();
        $mas35 = new Categoria();
        $mas40 = new Categoria();
        $mas45 = new Categoria();

        $mas30->setNombre('+30');
        $mas35->setNombre('+35');
        $mas40->setNombre('+40');
        $mas45->setNombre('+45');

        $manager->persist($torneo);
        $manager->persist($masculino);
        $manager->persist($femenino);
        $manager->persist($mas30);
        $manager->persist($mas35);
        $manager->persist($mas40);
        $manager->persist($mas45);

        $manager->flush();
    }
}
