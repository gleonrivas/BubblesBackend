<?php

namespace App\Entity;

use App\Repository\MensajeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MensajeRepository::class)]
class Mensaje
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 800)]
    private ?string $mensaje = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_envio = null;

    #[ORM\Column(length: 50)]
    private ?string $tipoMensaje = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $imagen = null;

    #[ORM\Column]
    private ?bool $leido = null;


    #[ORM\ManyToOne(inversedBy: 'mensaje')]
    #[ORM\JoinColumn(name: "emisor" , nullable: false)]
    private ?Perfil $emisor = null;

    #[ORM\ManyToOne(inversedBy: 'mensaje')]
    #[ORM\JoinColumn(name: "receptor" , nullable: false)]
    private ?Perfil $receptor = null;



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
    public function getMensaje(): ?string
    {
        return $this->mensaje;
    }

    /**
     * @param string|null $mensaje
     */
    public function setMensaje(?string $mensaje): void
    {
        $this->mensaje = $mensaje;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getFechaEnvio(): ?\DateTimeInterface
    {
        return $this->fecha_envio;
    }

    /**
     * @param \DateTimeInterface|null $fecha_envio
     */
    public function setFechaEnvio(?\DateTimeInterface $fecha_envio): void
    {
        $this->fecha_envio = $fecha_envio;
    }

    /**
     * @return string|null
     */
    public function getTipoMensaje(): ?string
    {
        return $this->tipoMensaje;
    }

    /**
     * @param string|null $tipoMensaje
     */
    public function setTipoMensaje(?string $tipoMensaje): void
    {
        $this->tipoMensaje = $tipoMensaje;
    }

    /**
     * @return string|null
     */
    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    /**
     * @param string|null $imagen
     */
    public function setImagen(?string $imagen): void
    {
        $this->imagen = $imagen;
    }

    /**
     * @return bool|null
     */
    public function getLeido(): ?bool
    {
        return $this->leido;
    }

    /**
     * @param bool|null $leido
     */
    public function setLeido(?bool $leido): void
    {
        $this->leido = $leido;
    }

    /**
     * @return Perfil|null
     */
    public function getEmisor(): ?Perfil
    {
        return $this->emisor;
    }

    /**
     * @param Perfil|null $emisor
     */
    public function setEmisor(?Perfil $emisor): void
    {
        $this->emisor = $emisor;
    }

    /**
     * @return Perfil|null
     */
    public function getReceptor(): ?Perfil
    {
        return $this->receptor;
    }

    /**
     * @param Perfil|null $receptor
     */
    public function setReceptor(?Perfil $receptor): void
    {
        $this->receptor = $receptor;
    }




}
