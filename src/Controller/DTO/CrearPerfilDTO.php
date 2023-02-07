<?php

namespace App\Controller\DTO;

class CrearPerfilDTO
{
    private string $descripcion;
    private string $username;
    private string $tipoCuenta;
    private string $fotoPerfil;



    public function __construct()
    {
    }




    /**
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getTipoCuenta(): string
    {
        return $this->tipoCuenta;
    }

    /**
     * @param string $tipoCuenta
     */
    public function setTipoCuenta(string $tipoCuenta): void
    {
        $this->tipoCuenta = $tipoCuenta;
    }

    /**
     * @return string
     */
    public function getFotoPerfil(): string
    {
        return $this->fotoPerfil;
    }

    /**
     * @param string $fotoPerfil
     */
    public function setFotoPerfil(string $fotoPerfil): void
    {
        $this->fotoPerfil = $fotoPerfil;
    }






}