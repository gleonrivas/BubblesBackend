<?php

namespace App\Controller\DTO;

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
      * @param Seguidor $seguidor
      */
     public function seguidorToDto(Seguidor $seguidor):SeguidorDTO
     {

         $seguidorDTO = new SeguidorDTO();
         $seguidorDTO->setFechaSeguimiento($seguidor->getFechaSeguimiento());
         $seguidorDTO->setIdPrincipal($this->usuarioToDto($seguidor->getIdPrincipal()));
         $seguidorDTO->setIdFollower($this->usuarioToDto($seguidor->getIdFollower()));

         return $seguidorDTO;

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

}