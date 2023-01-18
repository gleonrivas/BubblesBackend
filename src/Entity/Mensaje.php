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


    #[ORM\ManyToOne(inversedBy: 'emisor')]
    private ?Usuario $emisor = null;

    #[ORM\ManyToOne(inversedBy: 'receptor')]
    private ?Usuario $receptor = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMensaje(): ?string
    {
        return $this->mensaje;
    }

    public function setMensaje(string $mensaje): self
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    public function getFechaEnvio(): ?\DateTimeInterface
    {
        return $this->fecha_envio;
    }

    public function setFechaEnvio(\DateTimeInterface $fecha_envio): self
    {
        $this->fecha_envio = $fecha_envio;

        return $this;
    }

    public function getTipoMensaje(): ?string
    {
        return $this->tipoMensaje;
    }

    public function setTipoMensaje(string $tipoMensaje): self
    {
        $this->tipoMensaje = $tipoMensaje;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function isLeido(): ?bool
    {
        return $this->leido;
    }

    public function setLeido(bool $leido): self
    {
        $this->leido = $leido;

        return $this;
    }

    /**
     * @return Collection<int, Usuario>
     */
    public function getEmisor(): Collection
    {
        return $this->emisor;
    }

    public function addEmisor(Usuario $emisor): self
    {
        if (!$this->emisor->contains($emisor)) {
            $this->emisor->add($emisor);
            $emisor->setEmisor($this);
        }

        return $this;
    }

    public function removeEmisor(Usuario $emisor): self
    {
        if ($this->emisor->removeElement($emisor)) {
            // set the owning side to null (unless already changed)
            if ($emisor->getEmisor() === $this) {
                $emisor->setEmisor(null);
            }
        }

        return $this;
    }

    public function getReceptor(): ?Usuario
    {
        return $this->receptor;
    }

    public function setReceptor(?Usuario $receptor): self
    {
        $this->receptor = $receptor;

        return $this;
    }
}
