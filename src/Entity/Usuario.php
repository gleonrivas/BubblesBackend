<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Monolog\DateTimeImmutable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[ORM\Table(name:"usuario")]
#[UniqueEntity("id")]
class Usuario
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100)]
    private ?string $apellidos = null;

    #[ORM\Column(length: 9)]
    private ?string $telefono = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 100, nullable: false)]
    private ?string $contrasena;

    #[ORM\Column(length: 100)]
    private ?string $fecha_nacimiento = null;

    #[ORM\ManyToOne(inversedBy: 'usuario')]
    #[ORM\JoinColumn(name: "id_rol" , nullable: false)]
    private ?RolEntity $rol;

    #[ORM\OneToMany(mappedBy: 'id_usuario', targetEntity: AccessToken::class )]
    private ?Collection $token;

    #[ORM\OneToMany(mappedBy: 'id_usuario', targetEntity: Perfil::class)]
    private Collection $perfiles;

    public function __construct()
    {
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
     * @return string|null
     */
    public function getContrasena(): ?string
    {
        return $this->contrasena;
    }

    /**
     * @param string|null $contrasena
     */
    public function setContrasena(?string $contrasena): void
    {
        $this->contrasena = $contrasena;
    }

    /**
     * @return string|null
     */
    public function getFechaNacimiento(): ?string
    {
        return $this->fecha_nacimiento;
    }

    /**
     * @param string|null $fecha_nacimiento
     */
    public function setFechaNacimiento(?string $fecha_nacimiento): void
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    /**
     * @return RolEntity|null
     */
    public function getRol(): ?RolEntity
    {
        return $this->rol;
    }

    /**
     * @param RolEntity|null $rol
     */
    public function setRol(?RolEntity $rol): void
    {
        $this->rol = $rol;
    }

    /**
     * @return Collection|null
     */
    public function getToken(): ?Collection
    {
        return $this->token;
    }

    /**
     * @param Collection|null $token
     */
    public function setToken(?Collection $token): void
    {
        $this->token = $token;
    }

    /**
     * @return Collection
     */
    public function getPerfiles(): Collection
    {
        return $this->perfiles;
    }

    /**
     * @param Collection $perfiles
     */
    public function setPerfiles(Collection $perfiles): void
    {
        $this->perfiles = $perfiles;
    }


}