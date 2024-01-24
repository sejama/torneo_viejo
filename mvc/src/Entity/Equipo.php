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

    #[ORM\OneToMany(mappedBy: 'equipoLocal', targetEntity: Partido::class)]
    private Collection $partidosLocal;

    #[ORM\OneToMany(mappedBy: 'equipoVisitante', targetEntity: Partido::class)]
    private Collection $partidosVisitante;

    public function __construct()
    {
        $this->partidosLocal = new ArrayCollection();
        $this->partidosVisitante = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Partido>
     */
    public function getPartidosLocal(): Collection
    {
        return $this->partidosLocal;
    }

    public function addPartidoLocal(Partido $partidosLocal): static
    {
        if (!$this->partidosLocal->contains($partidosLocal)) {
            $this->partidosLocal->add($partidosLocal);
            $partidosLocal->setEquipoLocal($this);
        }

        return $this;
    }

    public function removePartidoLocal(Partido $partidosLocal): static
    {
        if ($this->partidosLocal->removeElement($partidosLocal)) {
            // set the owning side to null (unless already changed)
            if ($partidosLocal->getEquipoLocal() === $this) {
                $partidosLocal->setEquipoLocal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Partido>
     */
    public function getPartidosVisitante(): Collection
    {
        return $this->partidosVisitante;
    }

    public function addPartidosVisitante(Partido $partidosVisitante): static
    {
        if (!$this->partidosVisitante->contains($partidosVisitante)) {
            $this->partidosVisitante->add($partidosVisitante);
            $partidosVisitante->setEquipovisitante($this);
        }

        return $this;
    }

    public function removePartidosVisitante(Partido $partidosVisitante): static
    {
        if ($this->partidosVisitante->removeElement($partidosVisitante)) {
            // set the owning side to null (unless already changed)
            if ($partidosVisitante->getEquipovisitante() === $this) {
                $partidosVisitante->setEquipovisitante(null);
            }
        }

        return $this;
    }
}
