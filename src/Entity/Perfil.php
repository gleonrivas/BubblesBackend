<?php

namespace App\Entity;

use App\Repository\PerfilRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerfilRepository::class)]
class Perfil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $tipo_cuenta = null;

    #[ORM\Column(length: 500)]
    private ?string $foto_perfil = null;

    #[ORM\ManyToOne(inversedBy: 'id_usuario')]
    #[ORM\JoinColumn(name: "id" , nullable: false)]
    private ?Usuario $id_usuario = null;

    #[ORM\OneToMany(mappedBy: 'id_principal', targetEntity: Seguidor::class)]
    private Collection $seguidor_principal;

    #[ORM\OneToMany(mappedBy: 'id_follower', targetEntity: Seguidor::class)]
    private Collection $seguidor_follower;

    #[ORM\OneToMany(mappedBy: 'id_perfil', targetEntity: Publicacion::class, orphanRemoval: true)]
    private Collection $publicacion;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection
     */
    public function getSeguidorPrincipal(): Collection
    {
        return $this->seguidor_principal;
    }

    /**
     * @param Collection $seguidor_principal
     */
    public function setSeguidorPrincipal(Collection $seguidor_principal): void
    {
        $this->seguidor_principal = $seguidor_principal;
    }

    /**
     * @return Collection
     */
    public function getSeguidorFollower(): Collection
    {
        return $this->seguidor_follower;
    }

    /**
     * @param Collection $seguidor_follower
     */
    public function setSeguidorFollower(Collection $seguidor_follower): void
    {
        $this->seguidor_follower = $seguidor_follower;
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getTipoCuenta(): ?string
    {
        return $this->tipo_cuenta;
    }

    public function setTipoCuenta(?string $tipo_cuenta): self
    {
        $this->tipo_cuenta = $tipo_cuenta;

        return $this;
    }

    public function getFotoPerfil(): ?string
    {
        return $this->foto_perfil;
    }

    public function setFotoPerfil(?string $foto_perfil): self
    {
        $this->foto_perfil = $foto_perfil;

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
