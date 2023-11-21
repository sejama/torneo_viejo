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

    #[ORM\OneToMany(mappedBy: 'equipo', targetEntity: ZonaEquipo::class)]
    private Collection $zonaEquipos;

    public function __construct()
    {
        $this->zonaEquipos = new ArrayCollection();
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

    /**
     * @return Collection<int, ZonaEquipo>
     */
    public function getZonaEquipos(): Collection
    {
        return $this->zonaEquipos;
    }

    public function addZonaEquipo(ZonaEquipo $zonaEquipo): static
    {
        if (!$this->zonaEquipos->contains($zonaEquipo)) {
            $this->zonaEquipos->add($zonaEquipo);
            $zonaEquipo->setEquipo($this);
        }

        return $this;
    }

    public function removeZonaEquipo(ZonaEquipo $zonaEquipo): static
    {
        if ($this->zonaEquipos->removeElement($zonaEquipo)) {
            // set the owning side to null (unless already changed)
            if ($zonaEquipo->getEquipo() === $this) {
                $zonaEquipo->setEquipo(null);
            }
        }

        return $this;
    }
}
