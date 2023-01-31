<?php

namespace App\Controller\DTO;

use DateTimeInterface;
use Doctrine\DBAL\Types\Types;

class UsuarioDTO
{
    private int $id ;
    private string $nombre ;
    private string $apellidos ;
    private string $rolName;
    private string $telefono;
    private string $email;
    private string $contrasena;
    private DateTimeInterface $fecha_nacimiento;



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
    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    /**
     * @param string $apellidos
     */
    public function setApellidos(string $apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return string
     */
    public function getRolName(): string
    {
        return $this->rolName;
    }

    /**
     * @param string $rolName
     */
    public function setRolName(string $rolName): void
    {
        $this->rolName = $rolName;
    }

    /**
     * @return string
     */
    public function getTelefono(): string
    {
        return $this->telefono;
    }

    /**
     * @param string $telefono
     */
    public function setTelefono(string $telefono): void
    {
        $this->telefono = $telefono;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getContrasena(): string
    {
        return $this->contrasena;
    }

    /**
     * @param string $contrasena
     */
    public function setContrasena(string $contrasena): void
    {
        $this->contrasena = $contrasena;
    }

    /**
     * @return DateTimeInterface
     */
    public function getFechaNacimiento(): DateTimeInterface
    {
        return $this->fecha_nacimiento;
    }

    /**
     * @param DateTimeInterface $fecha_nacimiento
     */
    public function setFechaNacimiento(DateTimeInterface $fecha_nacimiento): void
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }





}