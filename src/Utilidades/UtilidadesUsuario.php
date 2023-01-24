<?php

namespace App\Utilidades;

use App\Entity\UsuarioEntity;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use App\Repository\UsuarioEntityRepository;

class UtilidadesUsuario
{

    public function extraerUsuarioFromJSON($json):string
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $usuario = $serializer->deserialize($json, UsuarioEntity::class, 'json');

        return $usuario;

    }

    public function existeEmail(UsuarioEntityRepository $usuarioEntityRepository, string $email):bool
    {
        if ($usuarioEntityRepository->findEmail($email) != null){
            return true;
        } else {
            return false;
        }
    }

    public function existeUsername(UsuarioEntityRepository $usuarioEntityRepository, string $username):bool
    {
        if ($usuarioEntityRepository->findUsername($username) != null){
            return true;
        } else {
            return false;
        }
    }




}