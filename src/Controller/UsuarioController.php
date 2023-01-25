<?php

namespace App\Controller;

use App\Entity\AccessToken;
use App\Entity\Usuario;
use App\Repository\AccessTokenRepository;
use App\Repository\RolEntityRepository;
use App\Repository\UsuarioRepository;
use App\Utilidades\Utilidades;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{


    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this-> doctrine = $managerRegistry;
    }
    #[Route('/usuario', name: 'app_usuario')]
    public function index(): JsonResponse
    {
       return $this->json([
           'message' => 'Controller',
           'path' => 'src/Controller/UsuarioController.php'
       ]);

    }


    #[Route('/usuario/listar', name: 'app_usuario_listar', methods: ['GET'])]
    public function listar(UsuarioRepository $repository, Utilidades $utilidades):JsonResponse
    {
        //Se obtiene la lista de usuarios de la BBDD
        $lista_usuarios = $repository->findAll();
        //Se transforma a Json
        $lista_Json = $utilidades->toJson($lista_usuarios);
        //se devuelve el Json transformado
        return new JsonResponse($lista_Json, 200,[], true);

    }

    #[Route('/usuario/guardar', name: 'app_usuario_crear', methods: ['POST'])]
    public function save(AccessTokenRepository $accessTokenRepository,Utilidades $utilidades, Request $request, UsuarioRepository $userRepository, RolEntityRepository $rolEntityRepository): JsonResponse
    {
        $em = $this->doctrine->getManager();
        //Obtener Json del body
        $json  = json_decode($request->getContent(), true);
        //Obtenemos los parámetros del JSON
        $nombre = $json['nombre'];
        $password = $json['password'];
        $rolname = $json['rol'];
        $apellidos = $json['apellidos'];
        $telefono = $json['telefono'];
        $email = $json['email'];
        $tipo_cuenta = $json['tipoCuenta'];
        $fecha_nacimiento = new \DateTime($json['fechaNacimiento']);


        //CREAR NUEVO USUARIO A PARTIR DEL JSON
        if($nombre != null and $password != null) {
            $usuarioNuevo = new Usuario();
            $usuarioNuevo->setNombre($nombre);
            $usuarioNuevo->setContrasena($utilidades->hashPassword($password));
            $usuarioNuevo->setApellidos($apellidos);
            $usuarioNuevo->setEmail($email);
            $usuarioNuevo->setTelefono($telefono);
            $usuarioNuevo->setTipoCuenta($tipo_cuenta);
            $usuarioNuevo->setFechaNacimiento($fecha_nacimiento);

            //GESTION DEL ROL
            if ($rolname == null) {
                //Obtenemos el rol de usuario por defecto
                $rolUser = $rolEntityRepository->findOneByIdentificador("usuario");
                $usuarioNuevo->setRol($rolUser);

            } else {
                $rol = $rolEntityRepository->findOneByIdentificador($rolname);
                $usuarioNuevo->setRol($rol);
            }

            //GUARDAR

            $userRepository->save($usuarioNuevo, true);

            $utilidades-> generateAccessToken($usuarioNuevo, $accessTokenRepository);

            return new JsonResponse("{ mensaje: Usuario creado correctamente }", 200, [], true);
        }else{
            return new JsonResponse("{ mensaje: No ha indicado usario y contraseña }", 101, [], true);
        }

    }








}
