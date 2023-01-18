<?php

namespace App\Entity;
use App\Repository\RolEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: RolEntityRepository::class)]
#[ORM\Table(name:"rol")]
#[UniqueEntity("id")]
class RolEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"id", type:"integer")]
    private ?int $id;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\OneToMany(mappedBy: 'id_rol', targetEntity: Usuario::class, orphanRemoval: true)]
    private Collection $usuario;

    #[ORM\ManyToMany(targetEntity: Permiso::class, mappedBy: 'rol')]
    private Collection $id_rol;


    /**
     * @param int|null $id
     * @param string|null $nombre
     */
    public function __construct(?int $id, ?string $nombre)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->usuario = new ArrayCollection();
        $this->id_rol = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * @param string|null $nombre
     */
    public function setNombre(?string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return Collection<int, Usuario>
     */
    public function getUsuario(): Collection
    {
        return $this->usuario;
    }

    public function addUsuario(Usuario $usuario): self
    {
        if (!$this->usuario->contains($usuario)) {
            $this->usuario->add($usuario);
            $usuario->setIdRol($this);
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): self
    {
        if ($this->usuario->removeElement($usuario)) {
            // set the owning side to null (unless already changed)
            if ($usuario->getIdRol() === $this) {
                $usuario->setIdRol(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Permiso>
     */
    public function getIdRol(): Collection
    {
        return $this->id_rol;
    }

    public function addIdRol(Permiso $idRol): self
    {
        if (!$this->id_rol->contains($idRol)) {
            $this->id_rol->add($idRol);
            $idRol->addRol($this);
        }

        return $this;
    }

    public function removeIdRol(Permiso $idRol): self
    {
        if ($this->id_rol->removeElement($idRol)) {
            $idRol->removeRol($this);
        }

        return $this;
    }




}