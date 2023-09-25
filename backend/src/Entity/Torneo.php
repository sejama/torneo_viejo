<?php

namespace App\Entity;

use App\Repository\TorneoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TorneoRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Torneo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["create", "update"])]
    private ?string $nombre = null;

    #[ORM\Column]
    #[Groups(["create", "update"])]
    private ?\DateTimeImmutable $fechaInicio = null;

    #[ORM\Column]
    #[Groups(["create", "update"])]
    private ?\DateTimeImmutable $fechaFin = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    #[Groups(["create", "update"])]
    private ?\DateTimeImmutable $fechaInicioInscripcion = null;

    #[ORM\Column]
    #[Groups(["create", "update"])]
    private ?\DateTimeImmutable $fechaFinInscripcion = null;

    #[ORM\OneToMany(mappedBy: 'torneo', targetEntity: Inscripcion::class)]
    private Collection $inscripcions;

    public function __construct()
    {
        $this->inscripcions = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt(): static
    {
        $this->createdAt = new \DateTimeImmutable('now');
        ;

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
        ;

        return $this;
    }

    /**
     * @return Collection<int, Inscripcion>
     */
    public function getInscripcions(): Collection
    {
        return $this->inscripcions;
    }

    public function addInscripcion(Inscripcion $inscripcion): static
    {
        if (!$this->inscripcions->contains($inscripcion)) {
            $this->inscripcions->add($inscripcion);
            $inscripcion->setTorneo($this);
        }

        return $this;
    }

    public function removeInscripcion(Inscripcion $inscripcion): static
    {
        if ($this->inscripcions->removeElement($inscripcion)) {
            // set the owning side to null (unless already changed)
            if ($inscripcion->getTorneo() === $this) {
                $inscripcion->setTorneo(null);
            }
        }

        return $this;
    }
}
