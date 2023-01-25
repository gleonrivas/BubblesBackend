<?php

namespace App\Utilidades;

use App\Entity\AccessToken;
use App\Entity\Usuario;
use App\Repository\AccessTokenRepository;
use DateTime;
use Doctrine\ORM\Mapping\Entity;
use ReallySimpleJWT\Token;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;




class Utilidades
{


    public function toJson($data):string
    {
        //Inicialización de serializador
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        //Conversion a JSON
        $json = $serializer->serialize($data, 'json');

        return $json;

    }


    public function  hashPassword($password):string
    {

        $factory = new PasswordHasherFactory([
            'common' => ['algorithm' => 'bcrypt'],
            'memory-hard' => ['algorithm' => 'sodium'],
        ]);

        $passwordHasher = $factory->getPasswordHasher('common');

        return $passwordHasher->hash($password);

    }


    public function  generateApiToken(Usuario $user, AccessTokenRepository $apiKeyRepository):string
    {

        //GENERO UN OBJETO CON API KEY NUEVO
        $apiKey = new AccessToken();
        $apiKey->setIdUsuario($user);
        $fechaActual5hour = date("Y-m-d H:i:s", strtotime('+5 hours'));
        $fechaExpiracion = DateTime::createFromFormat('Y-m-d H:i:s', $fechaActual5hour);
        $apiKey->setFechaExpiracion($fechaExpiracion);

        $tokenData = [
            'user_id' => $user->getId(),
            'username' => $user->getId(),
            'user_rol' => $user->getRol()->getNombre(),
            'fecha_expiracion' => $fechaExpiracion,
        ];

        $secret = $user->getContrasena();

        $token = Token::customPayload($tokenData, $secret);

        $apiKey->setToken($token);

        $apiKeyRepository->save($apiKey,true);


        return $token;
    }


    //no usada todavia
    public function esApiKeyValida($token, $permisoRequerido, AccessToken $apiKeyRepository,UsuarioRepository $usuarioRepository):bool
    {
        $apiKey = $apiKeyRepository->findOneBy(array("token" => $token));
        $fechaActual = DateTime::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"));
        $id_usuario = Token::getPayload($token)["user_id"];
        $rol_name= Token::getPayload($token)["user_rol"];
        $usuario= $usuarioRepository->findOneBy(array("id" => $id_usuario));

        return $apiKey == null
            or $permisoRequerido == $rol_name
            or $apiKey->getUsuario()->getId() == $id_usuario
            or $apiKey->getFechaExpiracion() <= $fechaActual
            or Token::validate($token, $usuario->getPassword());
    }





}