<?php

namespace App\Controller\DTO;

use App\Entity\Comentarios;
use App\Entity\Perfil;
use App\Entity\Seguidor;
use App\Entity\Usuario;

class DTOConverters
{

     /**
      * @param Perfil $perfil
      */
     public function perfilToDto(Perfil $perfil):PerfilDTO
     {

         $perfilDto = new PerfilDTO();
         $perfilDto->setFotoPerfil($perfil->getFotoPerfil());
         $perfilDto->setDescripcion($perfil->getDescripcion());
         $perfilDto->setUsername($perfil->getUsername());
         $perfilDto->setIdUsuario($this->usuarioToDto($perfil->getIdUsuario()));
        return $perfilDto;
     }




    /**
     * @param Usuario $usuario
     */
    public function usuarioToDto(Usuario $usuario):UsuarioDTO
    {
        $usuarioDto = new UsuarioDTO();
        $usuarioDto->setId($usuario->getId());
        $usuarioDto->setNombre($usuario->getNombre());
        $usuarioDto->setRolName($usuario->getRol()->getNombre());
        $usuarioDto->setEmail($usuario->getEmail());
        $usuarioDto->setContrasena($usuario->getContrasena());
        $usuarioDto->setTelefono($usuario->getTelefono());
        $usuarioDto->setApellidos($usuario->getApellidos());

        return $usuarioDto;

    }


    /**
     * @param Comentarios $comentario
     */
    public function comentarioToDto(Comentarios $comentario):ComentarioDTO
    {
       $comentarioDTO = new ComentarioDTO();
       $comentarioDTO->setId($comentario->getId());
       $comentarioDTO->setTexto($comentario->getTexto());
       $comentarioDTO->setIdPerfil($this->perfilToDto($comentario->getIdPerfil()));

        return $comentarioDTO;

    }



}