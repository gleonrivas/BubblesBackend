<?php

namespace App\Entity;

use App\Repository\ComentarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComentarioRepository::class)]
class Comentario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $texto = null;

    #[ORM\ManyToOne(inversedBy: 'comentario')]
    #[ORM\JoinColumn(name: "id_perfil" , nullable: false)]
    private ?Perfil $id_perfil = null;

    #[ORM\OneToMany(mappedBy: 'id_comentario', targetEntity: Like::class)]
    private Collection $id_comentario;

    public function __construct()
    {
        $this->id_comentario = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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



    public function getTexto(): ?string
    {
        return $this->texto;
    }

    public function setTexto(string $texto): self
    {
        $this->texto = $texto;

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
    public function getIdComentario(): Collection
    {
        return $this->id_comentario;
    }

    public function addIdComentario(Like $idComentario): self
    {
        if (!$this->id_comentario->contains($idComentario)) {
            $this->id_comentario->add($idComentario);
            $idComentario->setIdComentario($this);
        }

        return $this;
    }

    public function removeIdComentario(Like $idComentario): self
    {
        if ($this->id_comentario->removeElement($idComentario)) {
            // set the owning side to null (unless already changed)
            if ($idComentario->getIdComentario() === $this) {
                $idComentario->setIdComentario(null);
            }
        }

        return $this;
    }
}
