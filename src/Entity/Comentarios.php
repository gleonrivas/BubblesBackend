<?php

namespace App\Entity;

use App\Repository\ComentarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComentarioRepository::class)]
class Comentarios
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $texto = null;

    #[ORM\ManyToOne(inversedBy: 'comentarios')]
    #[ORM\JoinColumn(name: "id_perfil" , nullable: false)]
    private ?Perfil $id_perfil = null;

    #[ORM\OneToMany(mappedBy: 'id_comentario', targetEntity: Like::class)]
    private Collection $id_comentario;

    #[ORM\ManyToOne(inversedBy: 'comentarios')]
    #[ORM\JoinColumn(name: "id_publicacion" , nullable: true)]
    private ?Publicacion $id_publicacion;
    public function __construct()
    {
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
    public function getIdComentario(): Collection
    {
        return $this->id_comentario;
    }

    /**
     * @param Collection $id_comentario
     */
    public function setIdComentario(Collection $id_comentario): void
    {
        $this->id_comentario = $id_comentario;
    }

    /**
     * @return Publicacion|null
     */
    public function getIdPublicacion(): ?Publicacion
    {
        return $this->id_publicacion;
    }

    /**
     * @param Publicacion|null $id_publicacion
     */
    public function setIdPublicacion(?Publicacion $id_publicacion): void
    {
        $this->id_publicacion = $id_publicacion;
    }

}
