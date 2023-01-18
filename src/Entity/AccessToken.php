<?php

namespace App\Entity;

use App\Repository\AccessTokenRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccessTokenRepository::class)]
class AccessToken
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $token = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_expiracion = null;

    #[ORM\OneToOne(inversedBy: 'token', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: "id" ,nullable: false)]
    #[ORM\JoinTable(name: "usuario")]
    private ?Usuario $id_usuario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getFechaExpiracion(): ?\DateTimeInterface
    {
        return $this->fecha_expiracion;
    }

    public function setFechaExpiracion(\DateTimeInterface $fecha_expiracion): self
    {
        $this->fecha_expiracion = $fecha_expiracion;

        return $this;
    }

    public function getIdUsuario(): ?Usuario
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(Usuario $id_usuario): self
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }
}
