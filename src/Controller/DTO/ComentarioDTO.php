<?php

namespace App\Controller\DTO;


use App\Entity\Perfil;
use App\Entity\Publicacion;

class ComentarioDTO
{

    private int $id;
    private string $texto;

    private ?PerfilDTO $id_perfil;
    private ?PublicacionDTO $id_publicacion;

    private string $username;

    private string $urlImagen;

    private int $id_perfil_usuario;


    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getIdPerfilUsuario(): int
    {
        return $this->id_perfil_usuario;
    }

    /**
     * @param int $id_perfil_usuario
     */
    public function setIdPerfilUsuario(int $id_perfil_usuario): void
    {
        $this->id_perfil_usuario = $id_perfil_usuario;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUrlImagen(): string
    {
        return $this->urlImagen;
    }

    /**
     * @param string $urlImagen
     */
    public function setUrlImagen(string $urlImagen): void
    {
        $this->urlImagen = $urlImagen;
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
     * @return PerfilDTO|null
     */
    public function getIdPerfil(): ?PerfilDTO
    {
        return $this->id_perfil;
    }

    /**
     * @param PerfilDTO|null $id_perfil
     */
    public function setIdPerfil(?PerfilDTO $id_perfil): void
    {
        $this->id_perfil = $id_perfil;
    }

    /**
     * @return PublicacionDTO|null
     */
    public function getIdPublicacion(): ?PublicacionDTO
    {
        return $this->id_publicacion;
    }

    /**
     * @param PublicacionDTO|null $id_publicacion
     */
    public function setIdPublicacion(?PublicacionDTO $id_publicacion): void
    {
        $this->id_publicacion = $id_publicacion;
    }




}
