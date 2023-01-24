<?php

namespace App\Entity;

use App\Enums\rol_usuario;
use App\Enums\tipo_cuenta;
use App\Repository\UsuarioEntityRepository;
use Cassandra\Date;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioEntityRepository::class)]
class UsuarioEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 150)]
    private ?string $nombre;

    #[ORM\Column(length: 150)]
    private ?string $apellidos;

    #[ORM\Column(length: 9)]
    private ?string $telefono;

    #[ORM\Column(length: 150)]
    private ?string $email;

    #[ORM\Column(length: 150)]
    private ?rol_usuario $rol_usuario;

    #[ORM\Column(length: 150)]
    private ?tipo_cuenta $tipo_cuenta;

    #[ORM\Column(length: 150)]
    private ?Date $fecha_nacimiento;

    #[ORM\Column(length: 800)]
    private ?string $descripcion;

    #[ORM\Column(length: 150)]
    private ?Date $username;

    #[ORM\Column(length: 300)]
    private ?Date $foto_perfil;

    /**
     * @param int|null $id
     * @param string|null $nombre
     * @param string|null $apellidos
     * @param string|null $telefono
     * @param string|null $email
     * @param rol_usuario|null $rol_usuario
     * @param tipo_cuenta|null $tipo_cuenta
     * @param Date|null $fecha_nacimiento
     * @param string|null $descripcion
     * @param Date|null $username
     * @param Date|null $foto_perfil
     */
    public function __construct(?int $id, ?string $nombre, ?string $apellidos, ?string $telefono, ?string $email, ?rol_usuario $rol_usuario, ?tipo_cuenta $tipo_cuenta, ?Date $fecha_nacimiento, ?string $descripcion, ?Date $username, ?Date $foto_perfil)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->rol_usuario = $rol_usuario;
        $this->tipo_cuenta = $tipo_cuenta;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->descripcion = $descripcion;
        $this->username = $username;
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
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * @param string|null $nombre
     */
    public function setNombre(?string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string|null
     */
    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    /**
     * @param string|null $apellidos
     */
    public function setApellidos(?string $apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return string|null
     */
    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    /**
     * @param string|null $telefono
     */
    public function setTelefono(?string $telefono): void
    {
        $this->telefono = $telefono;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return rol_usuario|null
     */
    public function getRolUsuario(): ?rol_usuario
    {
        return $this->rol_usuario;
    }

    /**
     * @param rol_usuario|null $rol_usuario
     */
    public function setRolUsuario(?rol_usuario $rol_usuario): void
    {
        $this->rol_usuario = $rol_usuario;
    }

    /**
     * @return tipo_cuenta|null
     */
    public function getTipoCuenta(): ?tipo_cuenta
    {
        return $this->tipo_cuenta;
    }

    /**
     * @param tipo_cuenta|null $tipo_cuenta
     */
    public function setTipoCuenta(?tipo_cuenta $tipo_cuenta): void
    {
        $this->tipo_cuenta = $tipo_cuenta;
    }

    /**
     * @return Date|null
     */
    public function getFechaNacimiento(): ?Date
    {
        return $this->fecha_nacimiento;
    }

    /**
     * @param Date|null $fecha_nacimiento
     */
    public function setFechaNacimiento(?Date $fecha_nacimiento): void
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
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
     * @return Date|null
     */
    public function getUsername(): ?Date
    {
        return $this->username;
    }

    /**
     * @param Date|null $username
     */
    public function setUsername(?Date $username): void
    {
        $this->username = $username;
    }

    /**
     * @return Date|null
     */
    public function getFotoPerfil(): ?Date
    {
        return $this->foto_perfil;
    }

    /**
     * @param Date|null $foto_perfil
     */
    public function setFotoPerfil(?Date $foto_perfil): void
    {
        $this->foto_perfil = $foto_perfil;
    }


}
