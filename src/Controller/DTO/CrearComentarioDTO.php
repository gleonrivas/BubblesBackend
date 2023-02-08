<?php

namespace App\Controller\DTO;

class CrearComentarioDTO
{

    private string $texto;
    private int $perfil;

    public function __construct()
    {
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
     * @return int
     */
    public function getPerfil(): int
    {
        return $this->perfil;
    }

    /**
     * @param int $perfil
     */
    public function setPerfil(int $perfil): void
    {
        $this->perfil = $perfil;
    }




}