<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriaRepository::class)]
class Categoria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64, unique: true)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'categoria', targetEntity: TorneoGeneroCategoria::class)]
    private Collection $torneoGeneroCategorias;

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
            $torneoGeneroCategoria->setCategoria($this);
        }

        return $this;
    }

    public function removeTorneoGeneroCategoria(TorneoGeneroCategoria $torneoGeneroCategoria): static
    {
        if ($this->torneoGeneroCategorias->removeElement($torneoGeneroCategoria)) {
            // set the owning side to null (unless already changed)
            if ($torneoGeneroCategoria->getCategoria() === $this) {
                $torneoGeneroCategoria->setCategoria(null);
            }
        }

        return $this;
    }
}
