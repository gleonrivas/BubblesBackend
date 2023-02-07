<?php

namespace App\Controller;

use App\Controller\DTO\ComentarioDTO;
use App\Controller\DTO\DTOConverters;
use App\Controller\DTO\PerfilDTO;
use App\Repository\ComentarioRepository;
use App\Repository\PerfilRepository;
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
                $perfilDTO = $converters-> comentarioToDto($comentario);
                $json = $utilidades->toJson($perfilDTO, null);
                $lista_Json[] = json_decode($json);
            }
            return new JsonResponse($lista_Json, 200,[], false);
        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }


    }


}
