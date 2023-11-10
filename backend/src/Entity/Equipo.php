<?php

namespace App\Entity;

use App\Repository\EquipoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EquipoRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Equipo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["create", "update"])]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    #[Groups(["create", "update"])]
    private ?string $observacion = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToOne(mappedBy: 'equipo', cascade: ['persist', 'remove'])]
    private ?Inscripcion $inscripcion = null;

    #[ORM\ManyToOne(inversedBy: 'equipos')]
    private ?Genero $genero = null;

    #[ORM\ManyToOne(inversedBy: 'equipos')]
    private ?Categoria $categoria = null;

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

    public function getObservacion(): ?string
    {
        return $this->observacion;
    }

    public function setObservacion(?string $observacion): static
    {
        $this->observacion = $observacion;

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

    public function getInscripcion(): ?Inscripcion
    {
        return $this->inscripcion;
    }

    public function setInscripcion(?Inscripcion $inscripcion): static
    {
        // unset the owning side of the relation if necessary
        if ($inscripcion === null && $this->inscripcion !== null) {
            $this->inscripcion->setEquipo(null);
        }

        // set the owning side of the relation if necessary
        if ($inscripcion !== null && $inscripcion->getEquipo() !== $this) {
            $inscripcion->setEquipo($this);
        }

        $this->inscripcion = $inscripcion;

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
}
