<?php

namespace App\Entity;

use App\Repository\EquipoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipoRepository::class)]
class Equipo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'equipos')]
    private ?TorneoGeneroCategoria $torneoGeneroCategoria = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToOne(mappedBy: 'equipo', cascade: ['persist', 'remove'])]
    private ?ZonaEquipo $zonaEquipo = null;

    private $puntos = 0;
    private $partidosJugados = 0;
    private $partidosGanados = 0;
    private $partidosPerdidos = 0;
    private $setsAFavor = 0;
    private $setsEnContra = 0;
    private $puntosAFavor = 0;
    private $puntosEnContra = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getTorneoGeneroCategoria(): ?TorneoGeneroCategoria
    {
        return $this->torneoGeneroCategoria;
    }

    public function setTorneoGeneroCategoria(?TorneoGeneroCategoria $torneoGeneroCategoria): static
    {
        $this->torneoGeneroCategoria = $torneoGeneroCategoria;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt(): static
    {
        $this->createdAt = new \DateTimeImmutable('now');

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setUpdatedAt(): static
    {
        $this->updatedAt = new \DateTimeImmutable('now');

        return $this;
    }

    public function getZonaEquipo(): ?ZonaEquipo
    {
        return $this->zonaEquipo;
    }

    public function setZonaEquipo(?ZonaEquipo $zonaEquipo): static
    {
        // unset the owning side of the relation if necessary
        if ($zonaEquipo === null && $this->zonaEquipo !== null) {
            $this->zonaEquipo->setEquipo(null);
        }

        // set the owning side of the relation if necessary
        if ($zonaEquipo !== null && $zonaEquipo->getEquipo() !== $this) {
            $zonaEquipo->setEquipo($this);
        }

        $this->zonaEquipo = $zonaEquipo;

        return $this;
    }

    public function getPuntos(): int
    {
        return $this->puntos;
    }

    public function setPuntos(int $puntos): static
    {
        $this->puntos = $puntos;

        return $this;
    }

    public function getPartidosJugados(): int
    {
        return $this->partidosJugados;
    }

    public function setPartidosJugados(int $partidosJugados): static
    {
        $this->partidosJugados = $partidosJugados;

        return $this;
    }

    public function getPartidosGanados(): int
    {
        return $this->partidosGanados;
    }

    public function setPartidosGanados(int $partidosGanados): static
    {
        $this->partidosGanados = $partidosGanados;

        return $this;
    }

    public function getPartidosPerdidos(): int
    {
        return $this->partidosPerdidos;
    }

    public function setPartidosPerdidos(int $partidosPerdidos): static
    {
        $this->partidosPerdidos = $partidosPerdidos;

        return $this;
    }

    public function getSetsAFavor(): int
    {
        return $this->setsAFavor;
    }

    public function setSetsAFavor(int $setsAFavor): static
    {
        $this->setsAFavor = $setsAFavor;

        return $this;
    }

    public function getSetsEnContra(): int
    {
        return $this->setsEnContra;
    }

    public function setSetsEnContra(int $setsEnContra): static
    {
        $this->setsEnContra = $setsEnContra;

        return $this;
    }

    public function getDiferenciaSets(): int
    {
        return $this->setsAFavor - $this->setsEnContra;
    }

    

    public function getPuntosAFavor(): int
    {
        return $this->puntosAFavor;
    }

    public function setPuntosAFavor(int $puntosAFavor): static
    {
        $this->puntosAFavor = $puntosAFavor;

        return $this;
    }

    public function getPuntosEnContra(): int
    {
        return $this->puntosEnContra;
    }

    public function setPuntosEnContra(int $puntosEnContra): static
    {
        $this->puntosEnContra = $puntosEnContra;

        return $this;
    }

    public function getDiferenciaPuntos(): int
    {
        return $this->puntosAFavor - $this->puntosEnContra;
    }
}
