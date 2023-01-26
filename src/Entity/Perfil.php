<?php

namespace App\Entity;

use App\Repository\PerfilRepository;
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
    #[ORM\JoinColumn(name: "id_usuario" , nullable: false)]
    private ?Usuario $id_usuario;

    public function getId(): ?int
    {
        return $this->id;
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
