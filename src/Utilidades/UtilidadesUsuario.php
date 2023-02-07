<?php

namespace App\Utilidades;

use App\Entity\Usuario;
use App\Repository\UsuarioRepository;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class UtilidadesUsuario
{

    public function extraerUsuarioFromJSON($json):string
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $usuario = $serializer->deserialize($json, Usuario::class, 'json');

        return $usuario;

    }

    public function existeEmail(UsuarioRepository $usuarioRepository, string $email):bool
    {
        if ($usuarioRepository->findEmail($email) != null){
            return true;
        } else {
            return false;
        }
    }

    public function existeUsername(UsuarioRepository $usuarioRepository, string $username):bool
    {
        if ($usuarioRepository->findUsername($username) != null){
            return true;
        } else {
            return false;
        }
    }




}