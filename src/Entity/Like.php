<?php

namespace App\Entity;

use App\Repository\LikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikeRepository::class)]
#[ORM\Table(name: '`likes`')]
class Like
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero_likes = null;

    #[ORM\ManyToOne(inversedBy: 'id_comentario')]
    #[ORM\JoinColumn(name: "id" , nullable: false)]
    #[ORM\JoinTable(name: "comentario")]
    private ?Comentario $id_comentario = null;

    #[ORM\ManyToOne(inversedBy: 'id_publicacion')]
    #[ORM\JoinColumn(name: "id" , nullable: false)]
    #[ORM\JoinTable(name: "publicacion")]
    private ?publicacion $id_publicacion = null;

    #[ORM\ManyToOne(inversedBy: 'id_usuario')]
    #[ORM\JoinColumn(name: "id" , nullable: false)]
    #[ORM\JoinTable(name: "usuario")]
    private ?Usuario $id_usuario = null;

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

    public function getIdComentario(): ?Comentario
    {
        return $this->id_comentario;
    }

    public function setIdComentario(?Comentario $id_comentario): self
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

    public function getIdUsuario(): ?Usuario
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(?Usuario $id_usuario): self
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }
}
