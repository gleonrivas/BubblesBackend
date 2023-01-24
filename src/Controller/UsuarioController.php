<?php

namespace App\Controller;


use App\Repository\UsuarioEntityRepository;
use App\Entity\RolEntity;
use App\Entity\Usuario;
use App\Repository\RolEntityRepository;
use App\Repository\UsuarioRepository;
use App\Utilidades\Utilidades;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Tests\tmp\current_project_xml\src\Entity\UserXml;
use Symfony\Bundle\MakerBundle\Tests\tmp\current_project_xml\src\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{

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
    public function save(Request $request, Utilidades $utils,UserRepository $userRepository, RolEntityRepository $rolEntityRepository): JsonResponse
    {

        //Obtener Json del body
        $json  = json_decode($request->getContent(), true);

        //Obtenemos los parámetros del JSON
        $nombre = $json['nombre'];
        $rol = $json['rol'];
        $apellidos = $json['apellidos'];
        $telefono = $json['apellidos'];
        $email = $json['email'];
        $contrasena = $json['contrasena'];
        $tipo_cuenta = $json['tipoCuenta'];
        $fecha_nacimiento = $json['fechaNacimiento'];

        //CREAR NUEVO USUARIO A PARTIR DEL JSON
        if($nombre != null and $contrasena != null) {
            $usuarioNuevo = new Usuario();
            $usuarioNuevo->setNombre($nombre);
            $usuarioNuevo->setContrasena($contrasena);
            $usuarioNuevo->setApellidos($apellidos);
            $usuarioNuevo->setEmail($email);
            $usuarioNuevo->setTelefono($telefono);
            $usuarioNuevo->setTipoCuenta($tipo_cuenta);
            $usuarioNuevo->setFechaNacimiento($fecha_nacimiento);
            $usuarioNuevo->setRol($rol);

            //GESTION DEL ROL
            if ($rol == null) {
                //Obtenemos el rol de usuario por defecto
                $rolUser = $rolEntityRepository->findOneByIdentificador("usuario");
                $usuarioNuevo->setRol($rolUser);

            } else {
                $rol = $rolEntityRepository->findOneByIdentificador($rol);
                $usuarioNuevo->setRol($rol);
            }

            //GUARDAR

            $userRepository->save($usuarioNuevo, true);

            return new JsonResponse("{ mensaje: Usuario creado correctamente }", 200, [], true);
        }else{
            return new JsonResponse("{ mensaje: No ha indicado usario y contraseña }", 101, [], true);
        }

    }










    #[Route('/usuario/rol', name: 'app_usuario_listar_rol', methods: ['GET'])]
    public function listarRol(RolEntityRepository $repository, Utilidades $utils):JsonResponse
    {
        //Se obtiene la lista de usuarios de la BBDD
        $lista_roles = $repository->findAll();
        //Se transforma a Json
        $lista_Json = $utils->toJson($lista_roles);
        //se devuelve el Json transformado
        return new JsonResponse($lista_Json, 200,[], true);

    }



    #[Route('/usuario/crear', name: 'app_usuario_crear', methods: ['POST'])]
    public function crearUsuarioSiNoExiste(Request $request,UsuarioService $usuarioService, UtilidadesUsuario $utilidadesUsuario){

        $nuevoUsuario = $utilidadesUsuario->extraerUsuarioFromJSON($request);
        $usuarioService->guardarUsuario($nuevoUsuario);
    }
}
