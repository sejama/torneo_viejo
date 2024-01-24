<?php

namespace App\Entity;

use App\Repository\PartidoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartidoRepository::class)]
class Partido
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'partidos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cancha $cancha = null;

    #[ORM\ManyToOne(inversedBy: 'partidos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Zona $zona = null;

    #[ORM\ManyToOne(inversedBy: 'partidos')]
    private ?Equipo $equipoLocal = null;

    #[ORM\ManyToOne(inversedBy: 'partidosVisitante')]
    private ?Equipo $equipoVisitante = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCancha(): ?Cancha
    {
        return $this->cancha;
    }

    public function setCancha(?Cancha $cancha): static
    {
        $this->cancha = $cancha;

        return $this;
    }

    public function getZona(): ?Zona
    {
        return $this->zona;
    }

    public function setZona(?Zona $zona): static
    {
        $this->zona = $zona;

        return $this;
    }

    public function getEquipoLocal(): ?Equipo
    {
        return $this->equipoLocal;
    }

    public function setEquipoLocal(?Equipo $equipoLocal): static
    {
        $this->equipoLocal = $equipoLocal;

        return $this;
    }

    public function getEquipoVisitante(): ?Equipo
    {
        return $this->equipoVisitante;
    }

    public function setEquipoVisitante(?Equipo $equipoVisitante): static
    {
        $this->equipoVisitante = $equipoVisitante;

        return $this;
    }
}
