<?php

namespace App\Controller;

use App\Controller\DTO\CrearUsuarioDTO;
use App\Controller\DTO\DTOConverters;
use App\Controller\DTO\UsuarioDTO;
use App\Entity\AccessToken;
use App\Entity\Usuario;
use App\Repository\AccessTokenRepository;
use App\Repository\RolEntityRepository;
use App\Repository\UsuarioRepository;
use App\Utilidades\Utilidades;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

class UsuarioController extends AbstractController
{


    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this-> doctrine = $managerRegistry;
    }

    #[Route('/usuario', name: 'app_usuario', methods: ["GET"])]
    public function index(): JsonResponse
    {
       return $this->json([
           'message' => 'Controller',
           'path' => 'src/Controller/UsuarioController.php'
       ]);

    }


    #[Route('/api/usuario/listar', name: 'app_usuario_listar', methods: ['GET'])]
    #[OA\Tag(name: 'Usuarios')]
    #[Security(name: "apikey")]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: UsuarioDTO::class))))]
    public function listar(Request $request, Utilidades $utils, UsuarioRepository $repository,DtoConverters $converters, Utilidades $utilidades):JsonResponse
    {

        if($utils->comprobarPermisos($request, "usuario"))
        {
            $lista_usuarios= $repository->findAll();
            $lista_Json = array();
            foreach($lista_usuarios as $user){
                $usarioDto = $converters-> usuarioToDto($user);
                $json = $utilidades->toJson($usarioDto, null);
                $lista_Json[] = json_decode($json);
        }
            return new JsonResponse($lista_Json, 200,[], false);

        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }


    }

    #[Route('/api/usuario/listarPorNombre/{id}', name: 'app_usuario_buscar_id', methods: ['GET'])]
    #[OA\Tag(name: 'Usuarios')]
    #[Security(name: "apikey")]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: UsuarioDTO::class))))]
    public function buscaPorId(Request $request, Utilidades $utils, int $id, UsuarioRepository $repository,DtoConverters $converters, Utilidades $utilidades):JsonResponse
    {

        if($utils->comprobarPermisos($request, "usuario"))
        {
            $usuario = $repository->findOneBy(array('id'=>$id));

            $usarioDto = $converters-> usuarioToDto($usuario);
            $json = $utilidades->toJson($usarioDto, null);
            $lista_Json[] = json_decode($json);
            return new JsonResponse($lista_Json, 200,[], false);
        }
        else{
            return new JsonResponse("{message: Unauthorized}", 200, [], false);
        }

    }

    #[Route('/api/usuario/listar/{nombre}', name: 'app_usuario_buscar_nombre', methods: ['GET'])]
    #[OA\Tag(name: 'Usuarios')]
    #[Security(name: "apikey")]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: UsuarioDTO::class))))]
    public function buscarPorNombre(Request $request, Utilidades $utils, string $nombre, UsuarioRepository $repository,DtoConverters $converters, Utilidades $utilidades):JsonResponse
    {

        if($utils->comprobarPermisos($request, "usuario"))
        {
            $usuario = $repository->findOneBy(array('nombre'=>$nombre));

            $usarioDto = $converters-> usuarioToDto($usuario);
            $json = $utilidades->toJson($usarioDto, null);
            $lista_Json[] = json_decode($json);
            return new JsonResponse($lista_Json, 200,[], false);
        }
        else{
            return new JsonResponse("{message: Unauthorized}", 200, [], false);
        }

    }

    #[Route('/api/usuario/getIdUsuarioDelToken', name: 'app_usuario_buscar_nombre', methods: ['GET'])]
    #[OA\Tag(name: 'Usuarios')]
    #[Security(name: "apikey")]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: UsuarioDTO::class))))]
    public function buscarIdUsuarioPorToken(Request $request, Utilidades $utils, AccessTokenRepository $repository, Utilidades $utilidades):JsonResponse
    {

        if($utils->comprobarPermisos($request, "usuario"))
        {
            $json = $utilidades->toJson($repository->sacarIdUsuarioDelToken($request->headers->get("apikey")),null);
            return new JsonResponse(json_decode($json), 200,[], false);
        }
        else{
            return new JsonResponse("{message: Unauthorized}", 200, [], false);
        }
    }

    #[Route('/api/usuario/guardar', name: 'app_usuario_crear', methods: ['POST'])]
    #[OA\Tag(name: 'Usuarios')]
    #[OA\RequestBody(description:"DTO del usuario" ,required: true, content: new OA\JsonContent(ref: new Model(type:CrearUsuarioDTO::class)))]
    #[OA\Response(response: 200,description: "Usuario creado correctamente")]
    #[OA\Response(response: 101,description: "No ha indicado usario y contraseña")]
    public function save(AccessTokenRepository $accessTokenRepository,Utilidades $utilidades, Request $request, UsuarioRepository $userRepository, RolEntityRepository $rolEntityRepository): JsonResponse
    {
        $em = $this->doctrine->getManager();
        //Obtener Json del body
        $json  = json_decode($request->getContent(), true);
        //Obtenemos los parámetros del JSON
        $nombre = $json['nombre'];
        $apellidos = $json['apellidos'];
        $email = $json['email'];
        $telefono = $json['telefono'];
        $password = $json['password'];
        $fecha_nacimiento = $json['fechaNacimiento'];
        $rolname = $json['rol'];

        if (count($userRepository->encontrarporEmail($email))==0){
            //CREAR NUEVO USUARIO A PARTIR DEL JSON
            if($nombre != null and $password != null) {
                $usuarioNuevo = new Usuario();
                $usuarioNuevo->setNombre($nombre);
                $usuarioNuevo->setContrasena($utilidades->hashPassword($password));
                $usuarioNuevo->setApellidos($apellidos);
                $usuarioNuevo->setEmail($email);
                $usuarioNuevo->setTelefono($telefono);
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
        }else{
            return new JsonResponse("{ mensaje: Este usuario ya existe }", 101, [], true);
        }


    }

    /*#[Route('/usuario/contrasena', name: 'app_usuario_cambiar_contrasena', methods: ['POST'])]
    public function update(AccessTokenRepository $tokenRepository,
                           Utilidades $utilidades,
                           Request $request,
                           UsuarioRepository $userRepository,
                           RolEntityRepository $rolEntityRepository,
                           PasswordHasherFactory $hasherFactory): JsonResponse
    {

        $em = $this->doctrine->getManager();

        $tokenDeLaPeticion = $request->headers->get('token');

        $idUsuario = $tokenRepository->findBy(array('token' => $tokenDeLaPeticion));

        //Obtener Json del body
        $json  = json_decode($request->getContent(), true);

        //Obtenemos los parámetros del JSON
        $newPassword = $json['newPassword'];

        $nuevoUsuario = new Usuario();

        $nuevoUsuario->setNombre($usuarioDelToken->);
        $nuevoUsuario->setApellidos();
        $nuevoUsuario->setNombre();
        $nuevoUsuario->setNombre();
        $nuevoUsuario->setNombre();
        $nuevoUsuario->setNombre();


        $user->setPassword($utilidades->hashPassword($newPassword));

        // execute the queries on the database
        $em->flush();


    #[Route('/api/usuario/editar', name: 'app_usuario_editar', methods: ['POST'])]
    #[OA\Tag(name: 'Usuarios')]
    #[Security(name: "apikey")]
    #[OA\RequestBody(description:"DTO del usuario" ,required: true, content: new OA\JsonContent(ref: new Model(type:CrearUsuarioDTO::class)))]
    #[OA\Response(response: 200,description: "Usuario editado correctamente")]
    #[OA\Response(response: 101,description: "No ha indicado los datos del usuario")]
    public function editar(AccessTokenRepository $accessTokenRepository,Utilidades $utilidades, Request $request, UsuarioRepository $userRepository, RolEntityRepository $rolEntityRepository): JsonResponse
    {

        //Obtener Json del body
        $json  = json_decode($request->getContent(), true);
        //Obtenemos los parámetros del JSON
        $nombre = $json['nombre'];
        $password = $json['password'];
        $rolname = $json['rol'];
        $apellidos = $json['apellidos'];
        $telefono = $json['telefono'];
        $email = $json['email'];
        $fecha_nacimiento = new \DateTime($json['fechaNacimiento']);

        $userRepository->editar($nombre, $telefono,$apellidos,$email, $utilidades->hashPassword($password),$fecha_nacimiento,$utilidades->infoToken($request)->getId());
        $utilidades-> generateAccessToken($userRepository->findOneBy(array('id'=>$utilidades->infoToken($request)->getId())), $accessTokenRepository);
        return new JsonResponse("{ mensaje: Usuario modificado correctamente }", 200, [], true);

    }



        return new JsonResponse("{ mensaje: No ha indicado usario y contraseña }", 101, [], true);

    }*/
}
