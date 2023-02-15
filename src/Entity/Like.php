<?php

namespace App\Entity;

use App\Repository\LikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikeRepository::class)]
#[ORM\Table(name: 'likes')]
class Like
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero_likes = null;

    #[ORM\ManyToOne(inversedBy: 'like')]
    #[ORM\JoinColumn(name: "id_comentario" , nullable: true)]
    private ?Comentarios $id_comentario;

    #[ORM\ManyToOne(inversedBy: 'like')]
    #[ORM\JoinColumn(name: "id_publicacion" , nullable: true)]
    private ?Publicacion $id_publicacion;

    #[ORM\ManyToOne(inversedBy: 'like')]
    #[ORM\JoinColumn(name: "id_perfil" , nullable: true)]
    private ?Perfil $id_perfil;

    public function __construct()
    {
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroLikes(): ?int
    {
        return $this->numero_likes;
    }

    public function setNumeroLikes(int $numero_likes): self
    {
        $this->numero_likes = $numero_likes;

        return $this;
    }

    public function getIdComentario(): ?Comentarios
    {
        return $this->id_comentario;
    }

    public function setIdComentario(?Comentarios $id_comentario): self
    {
        $this->id_comentario = $id_comentario;

        return $this;
    }

    public function getIdPublicacion(): ?publicacion
    {
        return $this->id_publicacion;
    }

    public function setIdPublicacion(?publicacion $id_publicacion): self
    {
        $this->id_publicacion = $id_publicacion;

        return $this;
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




}
