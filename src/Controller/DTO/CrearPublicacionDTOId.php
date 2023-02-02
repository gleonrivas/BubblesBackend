<?php

namespace App\Controller\DTO;
use Symfony\Component\Validator\Constraints as Assert;

class CrearPublicacionDTOId
{
    private int $id;
    /**
     * @Assert\NotBlank()
     */
    private string $tipo_publicacion;

    private string $texto;

    private string $imagen;
    private string $tematica;
    /**
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private ?\DateTime $fecha_publicacion;

    private bool $activa;

    private int $id_perfil;

    /**
     * @param int $id
     * @param string $tipo_publicacion
     * @param string $texto
     * @param string $imagen
     * @param string $tematica
     * @param \DateTime|null $fecha_publicacion
     * @param bool $activa
     * @param int $id_perfil
     */
    public function __construct(int $id, string $tipo_publicacion, string $texto, string $imagen, string $tematica, ?\DateTime $fecha_publicacion, bool $activa, int $id_perfil)
    {
        $this->id = $id;
        $this->tipo_publicacion = $tipo_publicacion;
        $this->texto = $texto;
        $this->imagen = $imagen;
        $this->tematica = $tematica;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->activa = $activa;
        $this->id_perfil = $id_perfil;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @return int
     */
    public function getIdPerfil(): int
    {
        return $this->id_perfil;
    }

    /**
     * @param int $id_perfil
     */
    public function setIdPerfil(int $id_perfil): void
    {
        $this->id_perfil = $id_perfil;
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
     * @return \DateTime|null
     */
    public function getFechaPublicacion(): ?\DateTime
    {
        return $this->fecha_publicacion;
    }

    /**
     * @param \DateTime|null $fecha_publicacion
     */
    public function setFechaPublicacion(?\DateTime $fecha_publicacion): void
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