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

    private string $file;
    private string $tematica;
    /**
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */

    private bool $activa;

    private int $id_perfil;

    /**
     * @param int $id
     * @param string $tipo_publicacion
     * @param string $texto
     * @param string $file
     * @param string $tematica
     * @param bool $activa
     * @param int $id_perfil
     */
    public function __construct(int $id, string $tipo_publicacion, string $texto, string $file, string $tematica, bool $activa, int $id_perfil)
    {
        $this->id = $id;
        $this->tipo_publicacion = $tipo_publicacion;
        $this->texto = $texto;
        $this->file = $file;
        $this->tematica = $tematica;
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
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile(string $file): void
    {
        $this->file = $file;
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




}