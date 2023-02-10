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
    public string $fecha_publicacion;

    public string $texto;

    public string $imagen;
    public string $tematica;
    public bool $activa;

    /**
     * @param string $tipo_publicacion
     * @param string $fecha_publicacion
     * @param string $texto
     * @param string $imagen
     * @param string $tematica
     * @param bool $activa
     */
    public function __construct(string $tipo_publicacion, string $fecha_publicacion, string $texto, string $imagen, string $tematica, bool $activa)
    {
        $this->tipo_publicacion = $tipo_publicacion;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->texto = $texto;
        $this->imagen = $imagen;
        $this->tematica = $tematica;
        $this->activa = $activa;
    }

    /**
     * @return string
     */
    public function getTipoPublicacion(): string
    {
        return $this->tipo_publicacion;
    }

    /**
     * @param string $tipo_publicacion
     */
    public function setTipoPublicacion(string $tipo_publicacion): void
    {
        $this->tipo_publicacion = $tipo_publicacion;
    }

    /**
     * @return string
     */
    public function getFechaPublicacion(): string
    {
        return $this->fecha_publicacion;
    }

    /**
     * @param string $fecha_publicacion
     */
    public function setFechaPublicacion(string $fecha_publicacion): void
    {
        $this->fecha_publicacion = $fecha_publicacion;
    }

    /**
     * @return string
     */
    public function getTexto(): string
    {
        return $this->texto;
    }

    /**
     * @param string $texto
     */
    public function setTexto(string $texto): void
    {
        $this->texto = $texto;
    }

    /**
     * @return string
     */
    public function getImagen(): string
    {
        return $this->imagen;
    }

    /**
     * @param string $imagen
     */
    public function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }

    /**
     * @return string
     */
    public function getTematica(): string
    {
        return $this->tematica;
    }

    /**
     * @param string $tematica
     */
    public function setTematica(string $tematica): void
    {
        $this->tematica = $tematica;
    }

    /**
     * @return bool
     */
    public function isActiva(): bool
    {
        return $this->activa;
    }

    /**
     * @param bool $activa
     */
    public function setActiva(bool $activa): void
    {
        $this->activa = $activa;
    }





}