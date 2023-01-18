<?php

namespace App\Entity;

use App\Repository\PermisoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PermisoRepository::class)]
class Permiso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $ruta = null;

    #[ORM\ManyToMany(targetEntity: RolEntity::class, inversedBy: 'id_rol')]
    private Collection $rol;

    public function __construct()
    {
        $this->rol = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRuta(): ?string
    {
        return $this->ruta;
    }

    public function setRuta(string $ruta): self
    {
        $this->ruta = $ruta;

        return $this;
    }

    /**
     * @return Collection<int, RolEntity>
     */
    public function getRol(): Collection
    {
        return $this->rol;
    }

    public function addRol(RolEntity $rol): self
    {
        if (!$this->rol->contains($rol)) {
            $this->rol->add($rol);
        }

        return $this;
    }

    public function removeRol(RolEntity $rol): self
    {
        $this->rol->removeElement($rol);

        return $this;
    }
}
