<?php

namespace App\Entity;

use App\Repository\TerceroCuartoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TerceroCuartoRepository::class)]
class TerceroCuarto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Partido $partido1 = null;

    #[ORM\OneToOne(inversedBy: 'terceroCuarto', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?PlayOff $playOff = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPartido1(): ?Partido
    {
        return $this->partido1;
    }

    public function setPartido1(Partido $partido1): static
    {
        $this->partido1 = $partido1;

        return $this;
    }

    public function getPlayOff(): ?PlayOff
    {
        return $this->playOff;
    }

    public function setPlayOff(PlayOff $playOff): static
    {
        $this->playOff = $playOff;

        return $this;
    }
}
