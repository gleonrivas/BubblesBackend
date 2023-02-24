<?php

namespace App\Controller\DTO;

class CrearPerfilDTO
{

    private string $file;
    private string $descripcion;
    private string $username;
    private string $tipoCuenta;




    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile(string $file): void
    {
        $this->file = $file;
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







}