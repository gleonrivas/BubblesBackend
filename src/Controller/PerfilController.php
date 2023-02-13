<?php

namespace App\Controller;

use App\Controller\DTO\CrearPerfilDTO;
use App\Controller\DTO\CrearUsuarioDTO;
use App\Controller\DTO\DTOConverters;
use App\Controller\DTO\EditarPerfilDTO;
use App\Controller\DTO\MensajeRespuestaDTO;
use App\Controller\DTO\PerfilDTO;
use App\Controller\DTO\UsuarioDTO;
use App\Entity\Perfil;
use App\Entity\Usuario;
use App\Repository\AccessTokenRepository;
use App\Repository\PerfilRepository;
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
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

class PerfilController extends AbstractController
{

    private ManagerRegistry $doctrine;
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this-> doctrine = $managerRegistry;
    }


    #[Route('/perfil', name: 'app_perfil')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PerfilController.php',
        ]);
    }
    #[Route('api/perfil/listar', name: 'app_perfil_listar', methods: ['GET'])]
    #[OA\Tag(name: 'Perfiles')]
    #[Security(name: "apikey")]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: PerfilDTO::class))))]
    public function listar(Request $request, DtoConverters $converters,PerfilRepository $perfilRepository, Utilidades $utilidades):JsonResponse
    {
        //Se obtiene la lista de perfiles de la BBDD
        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            $lista_perfiles = $perfilRepository->findAll();
            //Se transforma a Json
            $lista_Json = array();
            //se devuelve el Json transformado
            foreach($lista_perfiles as $perfil){
                $perfilDTO = $converters-> perfilToDto($perfil);
                $json = $utilidades->toJson($perfilDTO, null);
                $lista_Json[] = json_decode($json);
            }
            return new JsonResponse($lista_Json, 200,[], false);
        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }


    }

    #[Route('api/perfil/{id}', name: 'app_perfil_id', methods: ['GET'])]
    #[OA\Tag(name: 'Perfiles')]
    #[Security(name: "apikey")]
    #[OA\HeaderParameter(name: "apiKey", required: true)]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: PerfilDTO::class))))]
    public function perfilPorId(Request $request, DtoConverters $converters,int $id, PerfilRepository $perfilRepository, Utilidades $utilidades):JsonResponse
    {
        //Se obtiene la lista de perfiles de la BBDD
        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            $criterio = array('id'=> $id);

            if($perfilRepository->findBy($criterio)==null){
                return new JsonResponse("{message: No existe el perfil}", 400,[], false);
            }else{
                $lista_perfiles = $perfilRepository->findBy($criterio);
                //Se transforma a Json
                $perfil = $lista_perfiles[0];

                $perfilDTO = new PerfilDTO();
                $perfilDTO->setId($perfil->getId());
                $perfilDTO->setFotoPerfil($perfil->getFotoPerfil());
                $perfilDTO->setUsername($perfil->getUsername());
                $perfilDTO->setDescripcion($perfil->getDescripcion());
                $perfilDTO->setTipoCuenta($perfil->getTipoCuenta());
                $json = $utilidades->toJson($perfilDTO, null);

                return new JsonResponse($json, 200, [], true);}

        }else{

            return new JsonResponse("{message: Unauthorized}", 401,[], false);
        }


    }
    #[Route('api/perfil/listar/{username}', name: 'app_perfil_listarPorNombre', methods: ['GET'])]
    #[OA\Tag(name: 'Perfiles')]
    #[Security(name: "apikey")]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: PerfilDTO::class))))]
    public function listarPorNombre(string $username,Request $request, DtoConverters $converters,PerfilRepository $perfilRepository, Utilidades $utilidades):JsonResponse
    {
        //Se obtiene la lista de perfiles de la BBDD
        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            $perfil = $perfilRepository->findOneBy(array('username'=>$username));
            //Se transforma a Json
            $lista_Json = array();
            //se devuelve el Json transformado

            $perfilDTO = $converters-> perfilToDto($perfil);
            $json = $utilidades->toJson($perfilDTO, null);
            $lista_Json[] = json_decode($json);

            return new JsonResponse($lista_Json, 200,[], false);
        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }

    }

    #[Route('api/perfil/listarPorUsuario/', name: 'app_perfil_listarPorUsuario', methods: ['GET'])]
    #[OA\Tag(name: 'Perfiles')]
    #[Security(name: "apikey")]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: PerfilDTO::class))))]
    public function listarPorUsuario(Request $request, DtoConverters $converters,PerfilRepository $perfilRepository, Utilidades $utilidades):JsonResponse
    {
        //Se obtiene la lista de perfiles de la BBDD
        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            $lista_perfiles = $perfilRepository->findBy(array('id_usuario'=>$utilidades->infoToken($request)->getId()));
            //Se transforma a Json
            $lista_Json = array();
            //se devuelve el Json transformado
            foreach($lista_perfiles as $perfil){
                $perfilDTO = $converters-> perfilToDto($perfil);
                $json = $utilidades->toJson($perfilDTO, null);
                $lista_Json[] = json_decode($json);
            }
            return new JsonResponse($lista_Json, 200,[], false);
        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }


    }

    #[Route('api/perfil/guardar', name: 'app_perfil_guardar', methods: ['POST'])]
    #[OA\Tag(name: 'Perfiles')]
    #[Security(name: "apikey")]
    #[OA\RequestBody(description:"DTO del perfil" ,required: true, content: new OA\JsonContent(ref: new Model(type:CrearPerfilDTO::class)))]
    #[OA\Response(response: 200,description: "Perfil creado correctamente")]
    #[OA\Response(response: 101,description: "No ha indicado los datos necesarios")]
    public function save(Utilidades $utilidades, Request $request, PerfilRepository $perfilRepository, UsuarioRepository $usuarioRepository): JsonResponse
    {


        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            $em = $this->doctrine->getManager();

            //Obtener Json del body
            $json  = json_decode($request->getContent(), true);
            //Obtenemos los parámetros del JSON
            $username = $json['username'];
            $descripcion = $json['descripcion'];
            $tipo_cuenta = $json['tipoCuenta'];
            $foto_perfil = $json['fotoPerfil'];

            //GUARDAR
            $nuevoPerfil = new Perfil();
            $nuevoPerfil->setUsername($username);
            $nuevoPerfil->setFotoPerfil($foto_perfil);
            $nuevoPerfil->setTipoCuenta($tipo_cuenta);
            $nuevoPerfil->setDescripcion($descripcion);
            $nuevoPerfil->setIdUsuario($usuarioRepository->findOneBy(array('id'=>$utilidades->infoToken($request)->getId())));

            $perfilRepository->save($nuevoPerfil, true);

            return new JsonResponse("{ mensaje: Perfil creado correctamente }", 200, [], true);

        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }



    }

    #[Route('api/perfil/editar', name: 'app_perfil_editar', methods: ['POST'])]
    #[OA\Tag(name: 'Perfiles')]
    #[Security(name: "apikey")]
    #[OA\RequestBody(description:"DTO del perfil" ,required: true, content: new OA\JsonContent(ref: new Model(type:EditarPerfilDTO::class)))]
    #[OA\Response(response: 200,description: "Perfil editado correctamente")]
    #[OA\Response(response: 101,description: "No ha indicado los datos del perfil")]
    public function editar(Request $request, PerfilRepository $perfilRepository, Utilidades $utilidades): JsonResponse
    {

        //Obtener Json del body
        $json  = json_decode($request->getContent(), true);
        //Obtenemos los parámetros del JSON
        $username = $json['username'];
        $descripcion = $json['descripcion'];
        $tipo_cuenta = $json['tipoCuenta'];
        $foto_perfil = $json['fotoPerfil'];

        $perfilRepository->editar($username,$descripcion,$foto_perfil,$tipo_cuenta, $utilidades->infoToken($request)->getId());

        return new JsonResponse("{ mensaje: Perfil editado correctamente }", 200, [], true);

    }

    #[Route('/api/perfil/eliminar/{id}', name: 'app_perfil_eliminar', methods: ['DELETE'])]
    #[OA\Tag(name: 'Perfiles')]
    #[Security(name: "apikey")]
    #[OA\Response(response: 200,description: "Perfil borrado correctamente")]
    #[OA\Response(response: 101,description: "No se ha borrado correctamente")]
    public function eliminar(Request $request,?int $id, PerfilRepository $perfilRepository, Utilidades $utilidades):JsonResponse
    {

        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            $perfilEncontrado = $perfilRepository->encontrarporId($id);

            $perfilRepository->remove($perfilEncontrado, true);

            return new JsonResponse("se ha eliminado correctamente", 200,[], true);

        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }

    }

}
