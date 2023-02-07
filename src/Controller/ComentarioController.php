<?php

namespace App\Controller;

use App\Controller\DTO\ComentarioDTO;
use App\Controller\DTO\DTOConverters;
use App\Repository\ComentarioRepository;
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
    #[OA\HeaderParameter(name: "apiKey", required: true)]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: ComentarioDTO::class))))]
    public function listar(Request $request,ComentarioRepository $comentarioRepository, DTOConverters $converters,Utilidades $utilidades):JsonResponse
    {
        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            $listaComentarios = $comentarioRepository->findAll();

            foreach($listaComentarios as $comentario){
                $comentarioDTO = $converters-> comentarioToDTO($comentario);
                $json = $utilidades->toJson($comentarioDTO, null);
                $lista_Json[] = json_decode($json);
            }
            return new JsonResponse($lista_Json, 200,[], false);
        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }
    }

    #[Route('api/comentario/listar/{id}', name: 'app_comentario_listar_id', methods: ['GET'])]
    #[OA\Tag(name: 'Comentarios')]
    #[Security(name: "apikey")]
    #[OA\HeaderParameter(name: "apiKey", required: true)]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: ComentarioDTO::class))))]
    public function listarPorIdUsuario(Request $request,ComentarioRepository $comentarioRepository, DTOConverters $converters,Utilidades $utilidades, int $id):JsonResponse
    {

        $listaComentarios = $comentarioRepository->listarComentariosPorIdUsuario($id);

        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            foreach($listaComentarios as $comentario){
                $comentarioDTO = $converters->comentarioToDTO($comentario);
                $json = $utilidades->toJson($comentarioDTO, null);
                $lista_Json[] = json_decode($json);
        }
            return new JsonResponse($lista_Json, 200,[], false);
        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }


    }

}
