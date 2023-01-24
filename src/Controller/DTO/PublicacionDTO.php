<?php

namespace App\Controller\DTO;
use Symfony\Component\Validator\Constraints as Assert;

class PublicacionDTO
{
    /**
     * @Assert\NotBlank()
     */
    public string $tipo_publicacion;

    /**
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    public ?\DateTime $fecha_publicacion;

    /**
     * @param string $tipo_publicacion
     * @param \DateTime|null $fecha_publicacion
     */
    public function __construct(string $tipo_publicacion, ?\DateTime $fecha_publicacion)
    {
        $this->tipo_publicacion = $tipo_publicacion;
        $this->fecha_publicacion = $fecha_publicacion;
    }

    /**
     * @return string
     */
    public function getTipoPublicacion(): string
    {
        return $this->tipo_publicacion;
    }

    /**
     * @return \DateTime|null
     */
    public function getFechaPublicacion(): ?\DateTime
    {
        return $this->fecha_publicacion;
    }


}