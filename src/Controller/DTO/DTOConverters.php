<?php

namespace App\Controller\DTO;

use App\Entity\Comentarios;
use App\Entity\Mensaje;
use App\Entity\Perfil;
use App\Entity\Publicacion;
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
         $perfilDto->setId($perfil->getId());
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
       $comentarioDTO->setIdPublicacion($this->publicacionToDTO($comentario->getIdPublicacion()));


        return $comentarioDTO;

    }

    /**
     * @param Mensaje $mensaje
     */
    public function mensajeToDTO(Mensaje $mensaje):MensajeDTO
    {
        $mensajeDTO = new MensajeDTO();
        $mensajeDTO->setMensaje($mensaje->getMensaje());
        $mensajeDTO->setTipoMensaje($mensaje->getTipoMensaje());
        $mensajeDTO->setImagen($mensaje->getImagen());
        $mensajeDTO->setLeido($mensaje->getLeido());
        $mensajeDTO->setFechaEnvio($mensaje->getFechaEnvio());
        $mensajeDTO->setEmisor($this->perfilToDto($mensaje->getEmisor()));
        $mensajeDTO->setReceptor($this->perfilToDto($mensaje->getReceptor()));

        return $mensajeDTO;

    }

    public function publicacionToDTO(Publicacion $publicacion):PublicacionDTO
    {
        $publicacionDTO = new PublicacionDTO();
        $publicacionDTO->setId($publicacion->getId());
        $publicacionDTO->setTipoPublicacion($publicacion->getTipoPublicacion());
        $publicacionDTO->setTexto($publicacion->getTexto());
        $publicacionDTO->setImagen($publicacion->getImagen());
        $publicacionDTO->setTematica($publicacion->getTematica());
        $publicacionDTO->setFechaPublicacion($publicacion->getFechaPublicacion()->format('Y-m-d H:i:s'));
        $publicacionDTO->setActiva($publicacion->getActiva());
        $publicacionDTO->setIdPerfil($this->perfilToDto($publicacion->getIdPerfil()));

        return $publicacionDTO;

    }



}