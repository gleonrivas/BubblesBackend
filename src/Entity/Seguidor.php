<?php

namespace App\Entity;

use App\Repository\SeguidorRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeguidorRepository::class)]
class Seguidor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_seguimiento = null;

    #[ORM\ManyToOne(inversedBy: 'seguidor_principal')]
    #[ORM\JoinColumn(name: "id_principal" , nullable: false)]
    private ?Usuario $id_principal = null;

    #[ORM\ManyToOne(inversedBy: 'seguidor_follower')]
    #[ORM\JoinColumn(name: "id_follower" , nullable: false)]
    private ?Usuario $id_follower = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaSeguimiento(): ?\DateTimeInterface
    {
        return $this->fecha_seguimiento;
    }

    public function setFechaSeguimiento(\DateTimeInterface $fecha_seguimiento): self
    {
        $this->fecha_seguimiento = $fecha_seguimiento;

        return $this;
    }

    public function getIdPrincipal(): ?Usuario
    {
        return $this->id_principal;
    }

    public function setIdPrincipal(?Usuario $id_principal): self
    {
        $this->id_principal = $id_principal;

        return $this;
    }

    public function getIdFollower(): ?Usuario
    {
        return $this->id_follower;
    }

    public function setIdFollower(?Usuario $id_follower): self
    {
        $this->id_follower = $id_follower;

        return $this;
    }
}
