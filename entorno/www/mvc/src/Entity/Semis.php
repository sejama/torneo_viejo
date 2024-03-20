<?php

namespace App\Entity;

use App\Repository\SemisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SemisRepository::class)]
class Semis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Partido $partido1 = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Partido $partido2 = null;

    #[ORM\OneToOne(inversedBy: 'semis', cascade: ['persist', 'remove'])]
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

    public function getPartido2(): ?Partido
    {
        return $this->partido2;
    }

    public function setPartido2(Partido $partido2): static
    {
        $this->partido2 = $partido2;

        return $this;
    }

    public function getPlayOff(): ?PlayOff
    {
        return $this->playOff;
    }

    public function setPlayOff(?PlayOff $playOff): static
    {
        $this->playOff = $playOff;

        return $this;
    }
}
