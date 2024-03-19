<?php

namespace App\Entity;

use App\Repository\ZonaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ZonaRepository::class)]
class Zona
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'zonas')]
    private ?TorneoGeneroCategoria $torneoGeneroCategoria = null;

    #[ORM\OneToMany(mappedBy: 'zona', targetEntity: ZonaEquipo::class)]
    private Collection $zonaEquipos;

    #[ORM\OneToMany(mappedBy: 'zona', targetEntity: Partido::class)]
    private Collection $partidos;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $clasificanOro = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $clasificanPlata = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $clasificanBronce = null;

    public function __construct()
    {
        $this->zonaEquipos = new ArrayCollection();
        $this->partidos = new ArrayCollection();
    }

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
            $zonaEquipo->setZona($this);
        }

        return $this;
    }

    public function removeZonaEquipo(ZonaEquipo $zonaEquipo): static
    {
        if ($this->zonaEquipos->removeElement($zonaEquipo)) {
            // set the owning side to null (unless already changed)
            if ($zonaEquipo->getZona() === $this) {
                $zonaEquipo->setZona(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Partido>
     */
    public function getPartidos(): Collection
    {
        return $this->partidos;
    }

    public function addPartido(Partido $partido): static
    {
        if (!$this->partidos->contains($partido)) {
            $this->partidos->add($partido);
            $partido->setZona($this);
        }

        return $this;
    }

    public function removePartido(Partido $partido): static
    {
        if ($this->partidos->removeElement($partido)) {
            // set the owning side to null (unless already changed)
            if ($partido->getZona() === $this) {
                $partido->setZona(null);
            }
        }

        return $this;
    }

    public function getClasificanOro(): ?int
    {
        return $this->clasificanOro;
    }

    public function setClasificanOro(int $clasificanOro): static
    {
        $this->clasificanOro = $clasificanOro;

        return $this;
    }

    public function getClasificanPlata(): ?int
    {
        return $this->clasificanPlata;
    }

    public function setClasificanPlata(int $clasificanPlata): static
    {
        $this->clasificanPlata = $clasificanPlata;

        return $this;
    }

    public function getClasificanBronce(): ?int
    {
        return $this->clasificanBronce;
    }

    public function setClasificanBronce(?int $clasificanBronce): static
    {
        $this->clasificanBronce = $clasificanBronce;

        return $this;
    }

}
