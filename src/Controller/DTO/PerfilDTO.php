<?php

namespace App\Controller\DTO;
use Symfony\Component\Validator\Constraints as Assert;

class PerfilDTO
{
    public ?int $id;


    public ?string $descripcion ;


    public ?string $username ;


    public ?string $tipo_cuenta ;


    public ?string $foto_perfil ;

    /**
     * @param int|null $id
     * @param string|null $descripcion
     * @param string|null $username
     * @param string|null $tipo_cuenta
     * @param string|null $foto_perfil
     */
    public function __construct(?int $id, ?string $descripcion, ?string $username, ?string $tipo_cuenta, ?string $foto_perfil)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->username = $username;
        $this->tipo_cuenta = $tipo_cuenta;
        $this->foto_perfil = $foto_perfil;
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
    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    /**
     * @param string|null $descripcion
     */
    public function setDescripcion(?string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getTipoCuenta(): ?string
    {
        return $this->tipo_cuenta;
    }

    /**
     * @param string|null $tipo_cuenta
     */
    public function setTipoCuenta(?string $tipo_cuenta): void
    {
        $this->tipo_cuenta = $tipo_cuenta;
    }

    /**
     * @return string|null
     */
    public function getFotoPerfil(): ?string
    {
        return $this->foto_perfil;
    }

    /**
     * @param string|null $foto_perfil
     */
    public function setFotoPerfil(?string $foto_perfil): void
    {
        $this->foto_perfil = $foto_perfil;
    }


}