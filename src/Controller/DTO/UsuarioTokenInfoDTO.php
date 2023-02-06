<?php

namespace App\Controller\DTO;

class UsuarioTokenInfoDTO
{
    private int $id ;
    private string $rol;

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
     * @return string
     */
    public function getRol(): string
    {
        return $this->rol;
    }

    /**
     * @param string $rol
     */
    public function setRol(string $rol): void
    {
        $this->rol = $rol;
    }




}