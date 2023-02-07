<?php

namespace App\Service;

use App\Entity\RolEntity;
use App\Entity\Usuario;
use App\Enums\rol_usuario;
use App\Enums\tipo_cuenta;
use App\Repository\UsuarioRepository;
use App\Utilidades\UtilidadesUsuario;
use mysql_xdevapi\Exception;

class UsuarioService
{

    public function guardarUsuario(UtilidadesUsuario $utilidadesUsuario, Usuario $usuario, UsuarioRepository $usuarioEntityRepository): ?string
    {

        $nuevoUsuario = new Usuario();

        try {

            // SETEA NOMBRE
            $nuevoUsuario->setNombre($usuario->getNombre());


            // SETEA APELLIDOS
            $nuevoUsuario->setApellidos($usuario->getApellidos());


            // SETEA TELEFONO
            $nuevoUsuario->setTelefono($usuario->getTelefono());

            $nuevoRol = new RolEntity();
            // SETEA EL ROL USUARIO A NORMAL SI O SI
            $nuevoUsuario->setRolUsuario($nuevoRol->setNombre(rol_usuario::usuario));


            // SETEA FOTO DE PERFIL
            $nuevoUsuario->setFotoPerfil($usuario->getFotoPerfil());


            // SETEA DESCRIPCION
            $nuevoUsuario->setDescripcion($usuario->getDescripcion());


            // SETEA FOTO DE PERFIL
            $nuevoUsuario->setFechaNacimiento($usuario->getFechaNacimiento());


            // SI EL USUARIO NO TIENE UN TIPO DE CUENTA, ESTE SE PONE EN NORMAL, SI NO, LE PONE EL QUE SE LE PASA.
            if ($usuario->getTipoCuenta() == null) {
                $nuevoUsuario->setTipoCuenta("normal");
            } else {
                $nuevoUsuario->setTipoCuenta($usuario->getTipoCuenta());
            }


            // SI EL EMAIL DEL USUARIO QUE SE LE PASA YA EXISTE DEVUELVE UN MENSAJE, SI NO, LO SETEA.
            if ($utilidadesUsuario->existeEmail($usuario->getEmail())) {
                return "¡Ese email ya está en uso!";
            } else {
                $nuevoUsuario->setEmail($usuario->getEmail());
            }


            // SI EL USERNAME DEL USUARIO QUE SE LE PASA YA EXISTE DEVUELVE UN MENSAJE, SI NO, LO SETEA.
            if ($utilidadesUsuario->existeUsername($usuario->getUsername())) {
                return "¡Ese nombre de usuario ya está en uso!";
            } else {
                $nuevoUsuario->setUsername($usuario->getUsername());
            }

            $usuarioEntityRepository->save($nuevoUsuario);
            return "Se ha guardado el usuario correctamente!";

        } catch (Exception $e) {
            return "Ha habido un error... Jódete anormal.";
        }
    }


}