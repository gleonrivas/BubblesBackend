<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\MaxDepth;

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

    #[ORM\Column(length: 100)]
    private ?string $tipo_cuenta = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_nacimiento = null;

    #[ORM\Column(length: 800, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $foto_perfil = null;

    #[ORM\OneToMany(mappedBy: 'id_usuario', targetEntity: RolEntity::class, orphanRemoval: true)]
    private Collection $rol;

    #[ORM\OneToMany(mappedBy: 'emisor', targetEntity: Mensaje::class)]

    private Collection $emisor ;

    #[ORM\OneToMany(mappedBy: 'receptor', targetEntity: Mensaje::class)]
    private Collection $receptor;

    #[ORM\OneToOne(mappedBy: 'id_usuario', cascade: ['persist', 'remove'])]
    private ?AccessToken $token = null;

    #[ORM\OneToMany(mappedBy: 'id_principal', targetEntity: Seguidor::class)]
    private Collection $seguidor_principal;

    #[ORM\OneToMany(mappedBy: 'id_follower', targetEntity: Seguidor::class)]
    private Collection $seguidor_follower;

    #[ORM\OneToMany(mappedBy: 'id_usuario', targetEntity: Comentario::class, orphanRemoval: true)]
    private Collection $comentario;

    #[ORM\OneToMany(mappedBy: 'id_usuario', targetEntity: Publicacion::class, orphanRemoval: true)]
    private Collection $publicacion;

    #[ORM\OneToMany(mappedBy: 'id_usuario', targetEntity: Like::class)]
    private Collection $id_usuario;

    /**
     * @param int|null $id
     * @param string|null $nombre
     * @param string|null $apellidos
     * @param string|null $telefono
     * @param string|null $email
     * @param string|null $tipo_cuenta
     * @param \DateTimeInterface|null $fecha_nacimiento
     * @param string|null $descripcion
     * @param string|null $username
     * @param string|null $foto_perfil
     */
    public function __construct(?int $id, ?string $nombre, ?string $apellidos, ?string $telefono, ?string $email, ?string $tipo_cuenta, ?\DateTimeInterface $fecha_nacimiento, ?string $descripcion, ?string $username, ?string $foto_perfil)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->tipo_cuenta = $tipo_cuenta;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->descripcion = $descripcion;
        $this->username = $username;
        $this->foto_perfil = $foto_perfil;
        $this->seguidor_principal = new ArrayCollection();
        $this->seguidor_follower = new ArrayCollection();
        $this->comentario = new ArrayCollection();
        $this->publicacion = new ArrayCollection();
        $this->id_usuario = new ArrayCollection();
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
     * @return \DateTimeInterface|null
     */
    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fecha_nacimiento;
    }

    /**
     * @param \DateTimeInterface|null $fecha_nacimiento
     */
    public function setFechaNacimiento(?\DateTimeInterface $fecha_nacimiento): void
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

    /**
     * @return Collection<int, Seguidor>
     */
    public function getSeguidorPrincipal(): Collection
    {
        return $this->seguidor_principal;
    }

    public function addSeguidorPrincipal(Seguidor $seguidorPrincipal): self
    {
        if (!$this->seguidor_principal->contains($seguidorPrincipal)) {
            $this->seguidor_principal->add($seguidorPrincipal);
            $seguidorPrincipal->setIdPrincipal($this);
        }

        return $this;
    }

    public function removeSeguidorPrincipal(Seguidor $seguidorPrincipal): self
    {
        if ($this->seguidor_principal->removeElement($seguidorPrincipal)) {
            // set the owning side to null (unless already changed)
            if ($seguidorPrincipal->getIdPrincipal() === $this) {
                $seguidorPrincipal->setIdPrincipal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Seguidor>
     */
    public function getSeguidorFollower(): Collection
    {
        return $this->seguidor_follower;
    }

    public function addSeguidorFollower(Seguidor $seguidorFollower): self
    {
        if (!$this->seguidor_follower->contains($seguidorFollower)) {
            $this->seguidor_follower->add($seguidorFollower);
            $seguidorFollower->setIdFollower($this);
        }

        return $this;
    }

    public function removeSeguidorFollower(Seguidor $seguidorFollower): self
    {
        if ($this->seguidor_follower->removeElement($seguidorFollower)) {
            // set the owning side to null (unless already changed)
            if ($seguidorFollower->getIdFollower() === $this) {
                $seguidorFollower->setIdFollower(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comentario>
     */
    public function getComentario(): Collection
    {
        return $this->comentario;
    }

    public function addComentario(Comentario $comentario): self
    {
        if (!$this->comentario->contains($comentario)) {
            $this->comentario->add($comentario);
            $comentario->setIdUsuario($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): self
    {
        if ($this->comentario->removeElement($comentario)) {
            // set the owning side to null (unless already changed)
            if ($comentario->getIdUsuario() === $this) {
                $comentario->setIdUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Publicacion>
     */
    public function getPublicacion(): Collection
    {
        return $this->publicacion;
    }

    public function addPublicacion(Publicacion $publicacion): self
    {
        if (!$this->publicacion->contains($publicacion)) {
            $this->publicacion->add($publicacion);
            $publicacion->setIdUsuario($this);
        }

        return $this;
    }

    public function removePublicacion(Publicacion $publicacion): self
    {
        if ($this->publicacion->removeElement($publicacion)) {
            // set the owning side to null (unless already changed)
            if ($publicacion->getIdUsuario() === $this) {
                $publicacion->setIdUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Like>
     */
    public function getIdUsuario(): Collection
    {
        return $this->id_usuario;
    }

    public function addIdUsuario(Like $idUsuario): self
    {
        if (!$this->id_usuario->contains($idUsuario)) {
            $this->id_usuario->add($idUsuario);
            $idUsuario->setIdUsuario($this);
        }

        return $this;
    }

    public function removeIdUsuario(Like $idUsuario): self
    {
        if ($this->id_usuario->removeElement($idUsuario)) {
            // set the owning side to null (unless already changed)
            if ($idUsuario->getIdUsuario() === $this) {
                $idUsuario->setIdUsuario(null);
            }
        }

        return $this;
    }



}