<?php

namespace App\Entity;

use App\Repository\TorneoGeneroCategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TorneoGeneroCategoriaRepository::class)]
#[UniqueEntity(fields:['genero', 'categoria'])]
class TorneoGeneroCategoria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'torneoGeneroCategorias')]
    private ?Torneo $torneo = null;

    #[ORM\ManyToOne(inversedBy: 'torneoGeneroCategorias')]
    private ?Genero $genero = null;

    #[ORM\ManyToOne(inversedBy: 'torneoGeneroCategorias')]
    private ?Categoria $categoria = null;

    #[ORM\OneToMany(mappedBy: 'torneoGeneroCategoria', targetEntity: Equipo::class)]
    private Collection $equipos;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->equipos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTorneo(): ?Torneo
    {
        return $this->torneo;
    }

    public function setTorneo(?Torneo $torneo): static
    {
        $this->torneo = $torneo;

        return $this;
    }

    public function getGenero(): ?Genero
    {
        return $this->genero;
    }

    public function setGenero(?Genero $genero): static
    {
        $this->genero = $genero;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): static
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * @return Collection<int, Equipo>
     */
    public function getEquipos(): Collection
    {
        return $this->equipos;
    }

    public function addEquipo(Equipo $equipo): static
    {
        if (!$this->equipos->contains($equipo)) {
            $this->equipos->add($equipo);
            $equipo->setTorneoGeneroCategoria($this);
        }

        return $this;
    }

    public function removeEquipo(Equipo $equipo): static
    {
        if ($this->equipos->removeElement($equipo)) {
            // set the owning side to null (unless already changed)
            if ($equipo->getTorneoGeneroCategoria() === $this) {
                $equipo->setTorneoGeneroCategoria(null);
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
