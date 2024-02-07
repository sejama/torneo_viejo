<?php

namespace App\Entity;

use App\Repository\TorneoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TorneoRepository::class)]
class Torneo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $fechaInicio = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $fechaFin = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $fechaInicioInscripcion = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $fechaFinInscripcion = null;

    #[ORM\OneToMany(mappedBy: 'torneo', targetEntity: TorneoGeneroCategoria::class)]
    private Collection $torneoGeneroCategorias;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->torneoGeneroCategorias = new ArrayCollection();
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeImmutable
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeImmutable $fechaInicio): static
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeImmutable
    {
        return $this->fechaFin;
    }

    public function setFechaFin(\DateTimeImmutable $fechaFin): static
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    public function getFechaInicioInscripcion(): ?\DateTimeImmutable
    {
        return $this->fechaInicioInscripcion;
    }

    public function setFechaInicioInscripcion(\DateTimeImmutable $fechaInicioInscripcion): static
    {
        $this->fechaInicioInscripcion = $fechaInicioInscripcion;

        return $this;
    }

    public function getFechaFinInscripcion(): ?\DateTimeImmutable
    {
        return $this->fechaFinInscripcion;
    }

    public function setFechaFinInscripcion(\DateTimeImmutable $fechaFinInscripcion): static
    {
        $this->fechaFinInscripcion = $fechaFinInscripcion;

        return $this;
    }

    /**
     * @return Collection<int, TorneoGeneroCategoria>
     */
    public function getTorneoGeneroCategorias(): Collection
    {
        return $this->torneoGeneroCategorias;
    }

    public function addTorneoGeneroCategoria(TorneoGeneroCategoria $torneoGeneroCategoria): static
    {
        if (!$this->torneoGeneroCategorias->contains($torneoGeneroCategoria)) {
            $this->torneoGeneroCategorias->add($torneoGeneroCategoria);
            $torneoGeneroCategoria->setTorneo($this);
        }

        return $this;
    }

    public function removeTorneoGeneroCategoria(TorneoGeneroCategoria $torneoGeneroCategoria): static
    {
        if ($this->torneoGeneroCategorias->removeElement($torneoGeneroCategoria)) {
            // set the owning side to null (unless already changed)
            if ($torneoGeneroCategoria->getTorneo() === $this) {
                $torneoGeneroCategoria->setTorneo(null);
            }
        }

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
}
