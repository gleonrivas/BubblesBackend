<?php

namespace App\Controller\DTO;

use App\Entity\Usuario;
use Doctrine\DBAL\Types\Types;

class MensajeDTO
{

    private ?int $id ;

    private ?string $mensaje ;
    private ?string $fecha_envio;
    private ?string $tipoMensaje ;
    private ?string $imagen ;
    private ?bool $leido;
    private PerfilDTO $emisor;
    private PerfilDTO $receptor;

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
     * @return string|null
     */
    public function getFechaEnvio(): ?string
    {
        return $this->fecha_envio;
    }

    /**
     * @param string|null $fecha_envio
     */
    public function setFechaEnvio(?string $fecha_envio): void
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
     * @return PerfilDTO
     */
    public function getEmisor(): PerfilDTO
    {
        return $this->emisor;
    }

    /**
     * @param PerfilDTO $emisor
     */
    public function setEmisor(PerfilDTO $emisor): void
    {
        $this->emisor = $emisor;
    }

    /**
     * @return PerfilDTO
     */
    public function getReceptor(): PerfilDTO
    {
        return $this->receptor;
    }

    /**
     * @param PerfilDTO $receptor
     */
    public function setReceptor(PerfilDTO $receptor): void
    {
        $this->receptor = $receptor;
    }





}