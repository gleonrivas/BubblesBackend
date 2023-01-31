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
    #[ORM\JoinColumn(name: "id_perfil" , nullable: false)]
    private ?Perfil $id_perfil ;

    #[ORM\OneToMany(mappedBy: 'publicacion', targetEntity: Like::class)]
    private Collection $publicacion;

    public function __construct()
    {
        $this->publicacion = new ArrayCollection();
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
    public function getTipoPublicacion(): ?string
    {
        return $this->tipo_publicacion;
    }

    /**
     * @param string|null $tipo_publicacion
     */
    public function setTipoPublicacion(?string $tipo_publicacion): void
    {
        $this->tipo_publicacion = $tipo_publicacion;
    }

    /**
     * @return string|null
     */
    public function getTexto(): ?string
    {
        return $this->texto;
    }

    /**
     * @param string|null $texto
     */
    public function setTexto(?string $texto): void
    {
        $this->texto = $texto;
    }

    /**
     * @return string|null
     */
    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    /**
     * @param string|null $imagen
     */
    public function setImagen(?string $imagen): void
    {
        $this->imagen = $imagen;
    }

    /**
     * @return string|null
     */
    public function getTematica(): ?string
    {
        return $this->tematica;
    }

    /**
     * @param string|null $tematica
     */
    public function setTematica(?string $tematica): void
    {
        $this->tematica = $tematica;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getFechaPublicacion(): ?\DateTimeInterface
    {
        return $this->fecha_publicacion;
    }

    /**
     * @param \DateTimeInterface|null $fecha_publicacion
     */
    public function setFechaPublicacion(?\DateTimeInterface $fecha_publicacion): void
    {
        $this->fecha_publicacion = $fecha_publicacion;
    }

    /**
     * @return bool|null
     */
    public function getActiva(): ?bool
    {
        return $this->activa;
    }

    /**
     * @param bool|null $activa
     */
    public function setActiva(?bool $activa): void
    {
        $this->activa = $activa;
    }

    /**
     * @return Perfil|null
     */
    public function getIdPerfil(): ?Perfil
    {
        return $this->id_perfil;
    }

    /**
     * @param Perfil|null $id_perfil
     */
    public function setIdPerfil(?Perfil $id_perfil): void
    {
        $this->id_perfil = $id_perfil;
    }

    /**
     * @return Collection
     */
    public function getPublicacion(): Collection
    {
        return $this->publicacion;
    }

    /**
     * @param Collection $publicacion
     */
    public function setPublicacion(Collection $publicacion): void
    {
        $this->publicacion = $publicacion;
    }


}
