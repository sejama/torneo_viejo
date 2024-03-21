<?php

namespace App\Entity;

use App\Repository\PlayOffRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayOffRepository::class)]
class PlayOff
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'playOffs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TorneoGeneroCategoria $torneoGeneroCategoria = null;

    #[ORM\OneToOne(mappedBy: 'playOff', cascade: ['persist', 'remove'])]
    private ?Cuartos $cuartos = null;

    #[ORM\OneToOne(mappedBy: 'playOff', cascade: ['persist', 'remove'])]
    private ?Semis $semis = null;

    #[ORM\OneToOne(mappedBy: 'playOff', cascade: ['persist', 'remove'])]
    private ?Fin $fin = null;

    #[ORM\Column]
    private ?bool $oro = false;

    #[ORM\Column]
    private ?bool $plata = false;

    #[ORM\Column]
    private ?bool $bronce = false;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCuartos(): ?Cuartos
    {
        return $this->cuartos;
    }

    public function setCuartos(?Cuartos $cuartos): static
    {
        // unset the owning side of the relation if necessary
        if ($cuartos === null && $this->cuartos !== null) {
            $this->cuartos->setPlayOff(null);
        }

        // set the owning side of the relation if necessary
        if ($cuartos !== null && $cuartos->getPlayOff() !== $this) {
            $cuartos->setPlayOff($this);
        }

        $this->cuartos = $cuartos;

        return $this;
    }

    public function getSemis(): ?Semis
    {
        return $this->semis;
    }

    public function setSemis(?Semis $semis): static
    {
        // unset the owning side of the relation if necessary
        if ($semis === null && $this->semis !== null) {
            $this->semis->setPlayOff(null);
        }

        // set the owning side of the relation if necessary
        if ($semis !== null && $semis->getPlayOff() !== $this) {
            $semis->setPlayOff($this);
        }

        $this->semis = $semis;

        return $this;
    }

    public function getFin(): ?Fin
    {
        return $this->fin;
    }

    public function setFin(?Fin $fin): static
    {
        // unset the owning side of the relation if necessary
        if ($fin === null && $this->fin !== null) {
            $this->fin->setPlayOff(null);
        }

        // set the owning side of the relation if necessary
        if ($fin !== null && $fin->getPlayOff() !== $this) {
            $fin->setPlayOff($this);
        }

        $this->fin = $fin;

        return $this;
    }

    public function isOro(): ?bool
    {
        return $this->oro;
    }

    public function setOro(bool $oro): static
    {
        $this->oro = $oro;

        return $this;
    }

    public function isPlata(): ?bool
    {
        return $this->plata;
    }

    public function setPlata(bool $plata): static
    {
        $this->plata = $plata;

        return $this;
    }

    public function isBronce(): ?bool
    {
        return $this->bronce;
    }

    public function setBronce(bool $bronce): static
    {
        $this->bronce = $bronce;

        return $this;
    }
}
