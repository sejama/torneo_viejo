<?php

namespace App\Entity;

use App\Repository\ZonaEquipoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ZonaEquipoRepository::class)]
class ZonaEquipo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'zonaEquipos')]
    private ?Zona $zona = null;

    #[ORM\ManyToOne(inversedBy: 'zonaEquipos')]
    private ?Equipo $equipo = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEquipo(): ?Equipo
    {
        return $this->equipo;
    }

    public function setEquipo(?Equipo $equipo): static
    {
        $this->equipo = $equipo;

        return $this;
    }
}
