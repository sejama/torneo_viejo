<?php

namespace App\Entity;

use App\Repository\TorneoGeneroCategoriaRepository;
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
}
