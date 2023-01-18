<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
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

    #[ORM\ManyToOne(inversedBy: 'usuario')]
    #[ORM\JoinColumn(name: "id_rol" ,nullable: false)]
    private ?RolEntity $id_rol;

    #[ORM\OneToMany(mappedBy: 'emisor', targetEntity: Mensaje::class)]
    private Collection $emisor ;

    #[ORM\OneToMany(mappedBy: 'receptor', targetEntity: Mensaje::class)]
    private Collection $receptor;

    #[ORM\OneToOne(mappedBy: 'id_usuario', cascade: ['persist', 'remove'])]
    private ?AccessToken $token = null;

    public function __construct()
    {
        $this->receptor = new ArrayCollection();
    }
    public function __constructo()
    {
        $this->emisor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTipoCuenta(): ?string
    {
        return $this->tipo_cuenta;
    }

    public function setTipoCuenta(string $tipo_cuenta): self
    {
        $this->tipo_cuenta = $tipo_cuenta;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento(\DateTimeInterface $fecha_nacimiento): self
    {
        $this->fecha_nacimiento = $fecha_nacimiento;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getFotoPerfil(): ?string
    {
        return $this->foto_perfil;
    }

    public function setFotoPerfil(?string $foto_perfil): self
    {
        $this->foto_perfil = $foto_perfil;

        return $this;
    }

    public function getIdRol(): ?RolEntity
    {
        return $this->id_rol;
    }

    public function setIdRol(?RolEntity $id_rol): self
    {
        $this->id_rol = $id_rol;

        return $this;
    }

    public function getEmisor(): ?Mensaje
    {
        return $this->emisor;
    }

    public function setEmisor(?Mensaje $emisor): self
    {
        $this->emisor = $emisor;

        return $this;
    }

    /**
     * @return Collection<int, Mensaje>
     */
    public function getReceptor(): Collection
    {
        return $this->receptor;
    }

    public function addReceptor(Mensaje $receptor): self
    {
        if (!$this->receptor->contains($receptor)) {
            $this->receptor->add($receptor);
            $receptor->setReceptor($this);
        }

        return $this;
    }

    public function removeReceptor(Mensaje $receptor): self
    {
        if ($this->receptor->removeElement($receptor)) {
            // set the owning side to null (unless already changed)
            if ($receptor->getReceptor() === $this) {
                $receptor->setReceptor(null);
            }
        }

        return $this;
    }

    public function getIdToken(): ?AccessToken
    {
        return $this->id_token;
    }

    public function setIdToken(AccessToken $id_token): self
    {
        // set the owning side of the relation if necessary
        if ($id_token->getIdUsuario() !== $this) {
            $id_token->setIdUsuario($this);
        }

        $this->id_token = $id_token;

        return $this;
    }
}
