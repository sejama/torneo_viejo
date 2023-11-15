<?php

namespace App\Entity;

use App\Repository\GeneroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GeneroRepository::class)]
class Genero
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32, unique: true)]
    private ?string $nombre = null;

    #[ORM\OneToMany(mappedBy: 'genero', targetEntity: TorneoGeneroCategoria::class)]
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
            $torneoGeneroCategoria->setGenero($this);
        }

        return $this;
    }

    public function removeTorneoGeneroCategoria(TorneoGeneroCategoria $torneoGeneroCategoria): static
    {
        if ($this->torneoGeneroCategorias->removeElement($torneoGeneroCategoria)) {
            // set the owning side to null (unless already changed)
            if ($torneoGeneroCategoria->getGenero() === $this) {
                $torneoGeneroCategoria->setGenero(null);
            }
        }

        return $this;
    }
}
