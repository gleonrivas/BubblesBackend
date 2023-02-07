<?php

namespace App\Controller\DTO;
use App\Entity\Perfil;

class ComentarioDTO
{
    private int $id;
    private string $texto;

    private ?PerfilDTO $id_perfil;

    public function __construct()
    {
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


}