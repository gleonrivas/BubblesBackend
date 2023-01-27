<?php

namespace App\Controller\DTO;

class PerfilDTO
{

    private int $id;
    private string $descripcion;
    private string $username;
    private string $tipo_cuenta;
    private string $foto_perfil;

    private UsuarioDTO $id_usuario;

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
        return $this->tipo_cuenta;
    }

    /**
     * @param string $tipo_cuenta
     */
    public function setTipoCuenta(string $tipo_cuenta): void
    {
        $this->tipo_cuenta = $tipo_cuenta;
    }

    /**
     * @return string
     */
    public function getFotoPerfil(): string
    {
        return $this->foto_perfil;
    }

    /**
     * @param string $foto_perfil
     */
    public function setFotoPerfil(string $foto_perfil): void
    {
        $this->foto_perfil = $foto_perfil;
    }

    /**
     * @return UsuarioDTO
     */
    public function getIdUsuario(): UsuarioDTO
    {
        return $this->id_usuario;
    }

    /**
     * @param UsuarioDTO $id_usuario
     */
    public function setIdUsuario(UsuarioDTO $id_usuario): void
    {
        $this->id_usuario = $id_usuario;
    }




}