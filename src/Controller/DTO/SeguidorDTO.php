<?php

namespace App\Controller\DTO;

use App\Entity\Usuario;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;

class SeguidorDTO
{

    private int $id;
    private DateTimeInterface $fecha_seguimiento;
    private UsuarioDTO $id_principal;
    private UsuarioDTO $id_follower;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return DateTimeInterface
     */
    public function getFechaSeguimiento(): DateTimeInterface
    {
        return $this->fecha_seguimiento;
    }

    /**
     * @param DateTimeInterface $fecha_seguimiento
     */
    public function setFechaSeguimiento(DateTimeInterface $fecha_seguimiento): void
    {
        $this->fecha_seguimiento = $fecha_seguimiento;
    }

    /**
     * @return UsuarioDTO
     */
    public function getIdPrincipal(): UsuarioDTO
    {
        return $this->id_principal;
    }

    /**
     * @param UsuarioDTO $id_principal
     */
    public function setIdPrincipal(UsuarioDTO $id_principal): void
    {
        $this->id_principal = $id_principal;
    }

    /**
     * @return UsuarioDTO
     */
    public function getIdFollower(): UsuarioDTO
    {
        return $this->id_follower;
    }

    /**
     * @param UsuarioDTO $id_follower
     */
    public function setIdFollower(UsuarioDTO $id_follower): void
    {
        $this->id_follower = $id_follower;
    }


}