<?php

namespace App\Entity;

use App\Repository\ZonaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    public function __construct()
    {
        $this->zonaEquipos = new ArrayCollection();
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

}
