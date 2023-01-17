<?php

namespace App\Entity;
use App\Repository\RolEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: RolEntityRepository::class)]
#[ORM\Table(name:"rol")]
#[UniqueEntity("id")]
class RolEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(type: "string", length: 150)]
    private ?string $nombre;

    private $usuarios;
    #[ORM\OneToMany(mappedBy: RolEntity::class, targetEntity: UsuarioEntity::class)]
    private $usuario;

    /**
     * @param int|null $id
     * @param string|null $nombre
     */
    public function __construct(?int $id, ?string $nombre)
    {
        $this->id = $id;
        $this->nombre = $nombre;
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




}