<?php

namespace App\Controller;

use App\Controller\DTO\ComentarioDTO;
use App\Controller\DTO\CrearComentarioDTO;
use App\Controller\DTO\CrearPerfilDTO;
use App\Controller\DTO\DTOConverters;
use App\Controller\DTO\PerfilDTO;
use App\Entity\Comentarios;
use App\Entity\Perfil;
use App\Repository\ComentarioRepository;
use App\Repository\PerfilRepository;
use App\Repository\UsuarioRepository;
use App\Utilidades\Utilidades;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

class ComentarioController extends AbstractController
{
    #[Route('/comentario', name: 'app_comentario')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ComentarioController.php',
        ]);
    }

    #[Route('api/comentario/listar', name: 'app_comentario_listar', methods: ['GET'])]
    #[OA\Tag(name: 'Comentarios')]
    #[Security(name: "apikey")]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: ComentarioDTO::class))))]
    public function listar(Request $request, DtoConverters $converters,ComentarioRepository $comentarioRepository, Utilidades $utilidades):JsonResponse
    {
        //Se obtiene la lista de perfiles de la BBDD
        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            $lista_comentarios = $comentarioRepository->findAll();
            //Se transforma a Json
            $lista_Json = array();
            //se devuelve el Json transformado
            foreach($lista_comentarios as $comentario){
                $comentarioDTO = $converters-> comentarioToDto($comentario);
                $json = $utilidades->toJson($comentarioDTO, null);
                $lista_Json[] = json_decode($json);
            }
            return new JsonResponse($lista_Json, 200,[], false);
        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }


    }

    #[Route('api/comentario/listarPorLikes/{id_publicacion}', name: 'app_comentario_listarPorLikes', methods: ['GET'])]
    #[OA\Tag(name: 'Comentarios')]
    #[Security(name: "apikey")]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: ComentarioDTO::class))))]
    public function listarPorLikes(int $id_publicacion,Request $request, DtoConverters $converters,ComentarioRepository $comentarioRepository, Utilidades $utilidades):JsonResponse
    {
        //Se obtiene la lista de perfiles de la BBDD
        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            $lista_comentarios = $comentarioRepository->listarPorLikesYpublicacion($id_publicacion);
            //Se transforma a Json
            $lista_Json = array();
            //se devuelve el Json transformado
            foreach($lista_comentarios as $comentario){
                $comentarioDTO = $converters-> comentarioToDto($comentario);
                $json = $utilidades->toJson($comentarioDTO, null);
                $lista_Json[] = json_decode($json);
            }
            return new JsonResponse($lista_Json, 200,[], false);
        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }

    }

    #[Route('api/comentario/guardar', name: 'app_comentario_guardar', methods: ['POST'])]
    #[OA\Tag(name: 'Comentarios')]
    #[Security(name: "apikey")]
    #[OA\RequestBody(description:"DTO del comentario" ,required: true, content: new OA\JsonContent(ref: new Model(type:CrearComentarioDTO::class)))]
    #[OA\Response(response: 200,description: "Comentario creado correctamente")]
    #[OA\Response(response: 101,description: "No ha indicado los datos necesarios")]
    public function save(Utilidades $utilidades, Request $request,ComentarioRepository $comentarioRepository, PerfilRepository $perfilRepository, UsuarioRepository $usuarioRepository): JsonResponse
    {


        if($utilidades->comprobarPermisos($request, "usuario"))
        {

            //Obtener Json del body
            $json  = json_decode($request->getContent(), true);
            //Obtenemos los parámetros del JSON
            $comentario = $json['texto'];
            $perfil = $json['id_perfil'];

            //Guardamos el comentario
            $comentarioNuevo = new Comentarios();
            $comentarioNuevo->setTexto($json['texto']);
            $comentarioNuevo->setIdPerfil($perfilRepository->findOneBy(['id' => $json['id_perfil']]));

            $comentarioRepository->save($comentarioNuevo, true);

            return new JsonResponse("{ mensaje: Comentario creado correctamente }", 200, [], true);

        }else{
            return new JsonResponse("{message: Unauthorized}", 401,[], false);
        }
    }


    #[Route('/api/comentario/eliminar/{id}', name: 'app_comentario_eliminar', methods: ['DELETE'])]
    #[OA\Tag(name: 'Comentarios')]
    #[Security(name: "apikey")]
    #[OA\Response(response: 200, description: "Comentario eliminado correctamente")]
    #[OA\Response(response: 100, description: "El comentario no existe")]
    #[OA\Response(response: 101, description: "No ha indicado usario y contraseña")]
    public function eliminarComentario(Request $request, Utilidades $utilidades, ComentarioRepository $comentarioRepository, int $id): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {

            if ($comentarioRepository->findBy(array('id' => $id)) == null) {
                return new JsonResponse("{ mensaje: El comentario no existe }", 200, [], true);
            } else {

                $comentarioRepository->remove($comentarioRepository->findOneBy(array('id' => $id)), true);

                return new JsonResponse("{ mensaje: Comentario eliminado correctamente }", 200, [], true);
            }
        } else {
            return new JsonResponse("{message: Unauthorized}", 401, [], false);
        }
    }


}
