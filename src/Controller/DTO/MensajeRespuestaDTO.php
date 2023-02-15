<?php

namespace App\Controller\DTO;

use Symfony\Component\Validator\Constraints\Json;

class MensajeRespuestaDTO
{
    private string $mensaje;

    /**
     * @param string $mensaje
     */
    public function __construct(string $mensaje)
    {
        $this->mensaje = $mensaje;
    }

    /**
     * @return string
     */
    public function getMensaje(): string
    {
        return $this->mensaje;
    }

    /**
     * @param string $mensaje
     */
    public function setMensaje(string $mensaje): void
    {
        $this->mensaje = $mensaje;
    }


}