<?php

namespace App\Entity;

use App\Repository\PerfilRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerfilRepository::class)]
class Perfil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $tipo_cuenta = null;

    #[ORM\Column(length: 500)]
    private ?string $foto_perfil = null;

    #[ORM\Column(length: 500)]
    private ?string $carpeta = null;

    #[ORM\ManyToOne(inversedBy: 'perfil')]
    #[ORM\JoinColumn(name: "id_usuario" , nullable: false)]
    private ?Usuario $id_usuario;

    #[ORM\OneToMany(mappedBy: 'id_principal', targetEntity: Seguidor::class)]
    private Collection $seguidor_principal;

    #[ORM\OneToMany(mappedBy: 'id_follower', targetEntity: Seguidor::class)]
    private Collection $seguidor_follower;

    #[ORM\OneToMany(mappedBy: 'id_perfil', targetEntity: Publicacion::class)]
    private Collection $publicacion;

    #[ORM\OneToMany(mappedBy: 'id_perfil', targetEntity: Like::class)]
    private Collection $id_perfil;

    #[ORM\OneToMany(mappedBy: 'id_perfil', targetEntity: Comentarios::class)]
    private Collection $comentario;

    #[ORM\OneToMany(mappedBy: 'emisor', targetEntity: Mensaje::class)]
    private Collection $emisor ;

    #[ORM\OneToMany(mappedBy: 'receptor', targetEntity: Mensaje::class)]
    private Collection $receptor;

    public function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function getCarpeta(): ?string
    {
        return $this->carpeta;
    }

    /**
     * @param string|null $carpeta
     */
    public function setCarpeta(?string $carpeta): void
    {
        $this->carpeta = $carpeta;
    }



    /**
     * @return Collection
     */
    public function getEmisor(): Collection
    {
        return $this->emisor;
    }


    /**
     * @param Collection $emisor
     */
    public function setEmisor(Collection $emisor): void
    {
        $this->emisor = $emisor;
    }

    /**
     * @return Collection
     */
    public function getReceptor(): Collection
    {
        return $this->receptor;
    }

    /**
     * @param Collection $receptor
     */
    public function setReceptor(Collection $receptor): void
    {
        $this->receptor = $receptor;
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

    /**
     * @return Usuario|null
     */
    public function getIdUsuario(): ?Usuario
    {
        return $this->id_usuario;
    }

    /**
     * @param Usuario|null $id_usuario
     */
    public function setIdUsuario(?Usuario $id_usuario): void
    {
        $this->id_usuario = $id_usuario;
    }

    /**
     * @return Collection
     */
    public function getSeguidorPrincipal(): Collection
    {
        return $this->seguidor_principal;
    }

    /**
     * @param Collection $seguidor_principal
     */
    public function setSeguidorPrincipal(Collection $seguidor_principal): void
    {
        $this->seguidor_principal = $seguidor_principal;
    }

    /**
     * @return Collection
     */
    public function getSeguidorFollower(): Collection
    {
        return $this->seguidor_follower;
    }

    /**
     * @param Collection $seguidor_follower
     */
    public function setSeguidorFollower(Collection $seguidor_follower): void
    {
        $this->seguidor_follower = $seguidor_follower;
    }

    /**
     * @return Collection
     */
    public function getPublicacion(): Collection
    {
        return $this->publicacion;
    }

    /**
     * @param Collection $publicacion
     */
    public function setPublicacion(Collection $publicacion): void
    {
        $this->publicacion = $publicacion;
    }

    /**
     * @return Collection
     */
    public function getIdPerfil(): Collection
    {
        return $this->id_perfil;
    }

    /**
     * @param Collection $id_perfil
     */
    public function setIdPerfil(Collection $id_perfil): void
    {
        $this->id_perfil = $id_perfil;
    }

    /**
     * @return Collection
     */
    public function getComentario(): Collection
    {
        return $this->comentario;
    }

    /**
     * @param Collection $comentario
     */
    public function setComentario(Collection $comentario): void
    {
        $this->comentario = $comentario;
    }




}
