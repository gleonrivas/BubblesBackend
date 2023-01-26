<?php

namespace App\Entity;

use App\Repository\PublicacionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublicacionRepository::class)]
class Publicacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id ;

    #[ORM\Column(length: 50)]
    private ?string $tipo_publicacion;

    #[ORM\Column(length: 800)]
    private ?string $texto ;

    #[ORM\Column(length: 800, nullable: true)]
    private ?string $imagen ;

    #[ORM\Column(length: 100)]
    private ?string $tematica ;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_publicacion ;

    #[ORM\Column(nullable: true)]
    private ?bool $activa;

    #[ORM\ManyToOne(inversedBy: 'publicacion')]
    #[ORM\JoinColumn(name: "id_usuario" , nullable: false)]
    private ?Usuario $id_usuario ;

    #[ORM\OneToMany(mappedBy: 'id_publicacion', targetEntity: Like::class)]
    private Collection $id_publicacion;

    public function __construct()
    {
        $this->id_publicacion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipoPublicacion(): ?string
    {
        return $this->tipo_publicacion;
    }

    public function setTipoPublicacion(string $tipo_publicacion): self
    {
        $this->tipo_publicacion = $tipo_publicacion;

        return $this;
    }

    public function getTexto(): ?string
    {
        return $this->texto;
    }

    public function setTexto(string $texto): self
    {
        $this->texto = $texto;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getTematica(): ?string
    {
        return $this->tematica;
    }

    public function setTematica(string $tematica): self
    {
        $this->tematica = $tematica;

        return $this;
    }

    public function getFechaPublicacion(): ?\DateTimeInterface
    {
        return $this->fecha_publicacion;
    }

    public function setFechaPublicacion(\DateTimeInterface $fecha_publicacion): self
    {
        $this->fecha_publicacion = $fecha_publicacion;

        return $this;
    }

    public function isActiva(): ?bool
    {
        return $this->activa;
    }

    public function setActiva(?bool $activa): self
    {
        $this->activa = $activa;

        return $this;
    }


    public function setIdUsuario(?Usuario $id_usuario): self
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    /**
     * @return Collection<int, Like>
     */
    public function getIdPublicacion(): Collection
    {
        return $this->id_publicacion;
    }

    public function addIdPublicacion(Like $idPublicacion): self
    {
        if (!$this->id_publicacion->contains($idPublicacion)) {
            $this->id_publicacion->add($idPublicacion);
            $idPublicacion->setIdPublicacion($this);
        }

        return $this;
    }

    public function removeIdPublicacion(Like $idPublicacion): self
    {
        if ($this->id_publicacion->removeElement($idPublicacion)) {
            // set the owning side to null (unless already changed)
            if ($idPublicacion->getIdPublicacion() === $this) {
                $idPublicacion->setIdPublicacion(null);
            }
        }

        return $this;
    }
}
