<?php

namespace App\Utilidades;

use App\Controller\DTO\UsuarioDTO;
use App\Controller\DTO\UsuarioTokenInfoDTO;
use App\Entity\AccessToken;
use App\Entity\Usuario;
use App\Repository\AccessTokenRepository;
use App\Repository\UsuarioRepository;
use DateTime;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\Persistence\ManagerRegistry;
use ReallySimpleJWT\Token;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;




class Utilidades
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this-> doctrine = $managerRegistry;
    }

    public function toJson($data, ?array  $groups ): string
    {
        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups("user_query")->toArray();

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);


        if($groups != null){
            //Conversion a JSON con groups
            $json = $serializer->serialize($data, 'json', $context);
        }else{
            //Conversion a JSON
            $json = $serializer->serialize($data, 'json');
        }

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

    public function  verify($passwordPlain, $passwordBD):bool
    {
        $factory = new PasswordHasherFactory([
            'common' => ['algorithm' => 'bcrypt'],
            'memory-hard' => ['algorithm' => 'sodium'],
        ]);

        $passwordHasher = $factory->getPasswordHasher('common');

        return $passwordHasher->verify($passwordBD,$passwordPlain);

    }


    public function  generateAccessToken(Usuario $user, AccessTokenRepository $apiKeyRepository):string
    {

        //GENERO UN OBJETO CON API KEY NUEVO
        $accessToken = new AccessToken();
        $accessToken->setIdUsuario($user);
        $fechaActual5hour = date("Y-m-d H:i:s");
        $fechaExpiracion = DateTime::createFromFormat('Y-m-d H:i:s', $fechaActual5hour);
        $fechaExpiracion->modify('+5 hours');
        $accessToken->setFechaExpiracion($fechaExpiracion);

        $tokenData = [
            'user_id' => $user->getId(),
            'username' => $user->getId(),
            'user_rol' => $user->getRol()->getNombre(),
            'fecha_expiracion' => $fechaExpiracion,
        ];

        $secret = $user->getContrasena();

        $token = Token::customPayload($tokenData, $secret);

        $accessToken->setToken($token);

        $apiKeyRepository->save($accessToken,true);


        return $token;
    }

    public function infoToken(Request $request):UsuarioTokenInfoDTO{
        $token = $request->headers->get("apikey");
        $id_usuario = Token::getPayload($token)["user_id"];
        $rol_name= Token::getPayload($token)["user_rol"];
        $usuario = new UsuarioTokenInfoDTO();
        $usuario->setRol($rol_name);
        $usuario->setId($id_usuario);

        return $usuario;

    }


    public function comprobarPermisos(Request $request, $permiso){
        $em = $this-> doctrine->getManager();
        $userRepository = $em->getRepository(Usuario::class);
        $apikeyRepository = $em->getRepository(AccessToken::class);
        $token = $request->headers->get("apikey");

        return $token != null and $this->esAccesTokenValida($token, $permiso, $apikeyRepository, $userRepository);

    }


    public function esAccesTokenValida($token, $permisoRequerido, AccessTokenRepository $accessTokenRepository,UsuarioRepository $usuarioRepository):bool
    {
        $accesToken = $accessTokenRepository->findOneBy(array("token" => $token));
        $fechaActual = DateTime::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"));
        $id_usuario = Token::getPayload($token)["user_id"];
        $rol_name= Token::getPayload($token)["user_rol"];
        $usuario= $usuarioRepository->findOneBy(array("id" => $id_usuario));

        return $accesToken == null
            or $permisoRequerido == $rol_name
            or $accesToken->getIdUsuario()->getId() == $id_usuario
            or $accesToken->getFechaExpiracion() <= $fechaActual
            or Token::validate($token, $usuario->getContrasena());
    }





}