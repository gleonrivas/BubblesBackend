<?php

namespace App\Entity;
use App\Repository\RolEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: RolEntityRepository::class)]
#[ORM\Table(name:"rol")]
#[UniqueEntity("id")]
class RolEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"id", type:"integer")]
    private ?int $id;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'rol')]
    #[ORM\JoinColumn(name: "id" , nullable: false)]
    #[ORM\JoinTable(name: "usuario")]
    private ?Usuario $usuario;

    /**
     * @param int|null $id
     * @param string|null $nombre
     * @param Usuario|null $usuario
     */
    public function __construct(?int $id, ?string $nombre, ?Usuario $usuario)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->usuario = $usuario;
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
     * @return Usuario|null
     */
    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario|null $usuario
     */
    public function setUsuario(?Usuario $usuario): void
    {
        $this->usuario = $usuario;
    }



}