<?php

namespace App\Controller;

use App\Controller\DTO\DTOConverters;
use App\Controller\DTO\PerfilDTO;
use App\Repository\PerfilRepository;
use App\Utilidades\Utilidades;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

class MensajeController extends AbstractController
{
    #[Route('/mensaje', name: 'app_mensaje')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MensajeController.php',
        ]);
    }


    #[Route('api/mensaje/listar', name: 'app_mensaje_listar', methods: ['GET'])]
    #[OA\Tag(name: 'Mensajes')]
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




}
