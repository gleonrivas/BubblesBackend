<?php

namespace App\Controller\DTO;

class CrearMensajeDTO
{

    private ?string $mensaje ;
    private ?string $tipoMensaje ;
    private ?string $imagen ;
    private ?bool $leido;
    private int $emisor;
    private int $receptor;

    public function __construct()
    {
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
     * @return int
     */
    public function getEmisor(): int
    {
        return $this->emisor;
    }

    /**
     * @param int $emisor
     */
    public function setEmisor(int $emisor): void
    {
        $this->emisor = $emisor;
    }

    /**
     * @return int
     */
    public function getReceptor(): int
    {
        return $this->receptor;
    }

    /**
     * @param int $receptor
     */
    public function setReceptor(int $receptor): void
    {
        $this->receptor = $receptor;
    }




}