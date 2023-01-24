<?php

namespace App\Service;

use App\Entity\UsuarioEntity;
use App\Enums\rol_usuario;
use App\Enums\tipo_cuenta;
use App\Repository\UsuarioEntityRepository;
use App\Utilidades\UtilidadesUsuario;
use mysql_xdevapi\Exception;

class UsuarioService
{

    public function guardarUsuario(UtilidadesUsuario $utilidadesUsuario, UsuarioEntity $usuarioEntity, UsuarioEntityRepository $usuarioEntityRepository): ?string
    {

        $nuevoUsuario = new UsuarioEntity();

        try {

            // SETEA NOMBRE
            $nuevoUsuario->setNombre($usuarioEntity->getNombre());


            // SETEA APELLIDOS
            $nuevoUsuario->setApellidos($usuarioEntity->getApellidos());


            // SETEA TELEFONO
            $nuevoUsuario->setTelefono($usuarioEntity->getTelefono());


            // SETEA EL ROL USUARIO A NORMAL SI O SI
            $nuevoUsuario->setRolUsuario(rol_usuario::usuario);


            // SETEA FOTO DE PERFIL
            $nuevoUsuario->setFotoPerfil($usuarioEntity->getFotoPerfil());


            // SETEA DESCRIPCION
            $nuevoUsuario->setDescripcion($usuarioEntity->getDescripcion());


            // SETEA FOTO DE PERFIL
            $nuevoUsuario->setFechaNacimiento($usuarioEntity->getFechaNacimiento());


            // SI EL USUARIO NO TIENE UN TIPO DE CUENTA, ESTE SE PONE EN NORMAL, SI NO, LE PONE EL QUE SE LE PASA.
            if ($usuarioEntity->getTipoCuenta() == null) {
                $nuevoUsuario->setTipoCuenta(tipo_cuenta::normal);
            } else {
                $nuevoUsuario->setTipoCuenta($usuarioEntity->getTipoCuenta());
            }


            // SI EL EMAIL DEL USUARIO QUE SE LE PASA YA EXISTE DEVUELVE UN MENSAJE, SI NO, LO SETEA.
            if ($utilidadesUsuario->existeEmail($usuarioEntity->getEmail())) {
                return "¡Ese email ya está en uso!";
            } else {
                $nuevoUsuario->setEmail($usuarioEntity->getEmail());
            }


            // SI EL USERNAME DEL USUARIO QUE SE LE PASA YA EXISTE DEVUELVE UN MENSAJE, SI NO, LO SETEA.
            if ($utilidadesUsuario->existeUsername($usuarioEntity->getUsername())) {
                return "¡Ese nombre de usuario ya está en uso!";
            } else {
                $nuevoUsuario->setUsername($usuarioEntity->getUsername());
            }

            $usuarioEntityRepository->save($nuevoUsuario);
            return "Se ha guardado el usuario correctamente!";

        } catch (\Exception $e) {
            return "Ha habido un error... Jódete anormal.";
        }
    }


}