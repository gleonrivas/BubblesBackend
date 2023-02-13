<?php

namespace App\Controller;

use App\Controller\DTO\CrearMensajeDTO;
use App\Controller\DTO\CrearPerfilDTO;
use App\Controller\DTO\DTOConverters;
use App\Controller\DTO\MensajeDTO;
use App\Controller\DTO\PerfilDTO;
use App\Controller\DTO\UsuarioDTO;
use App\Entity\Mensaje;
use App\Repository\MensajeRepository;
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
    public function listar(Request $request, DtoConverters $converters,MensajeRepository $mensajeRepository, Utilidades $utilidades):JsonResponse
    {
        //Se obtiene la lista de perfiles de la BBDD
        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            $lista_mensajes = $mensajeRepository->findAll();
            //Se transforma a Json
            $lista_Json = array();
            //se devuelve el Json transformado
            foreach($lista_mensajes as $mensaje){
                $mensajeDTO = $converters-> mensajeToDTO($mensaje);
                $json = $utilidades->toJson($mensajeDTO, null);
                $lista_Json[] = json_decode($json);
            }
            return new JsonResponse($lista_Json, 200,[], false);
        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }


    }

    #[Route('api/mensaje/listarChats/{id_perfil}', name: 'app_mensaje_listarChat', methods: ['GET'])]
    #[OA\Tag(name: 'Mensajes')]
    #[Security(name: "apikey")]
    #[OA\Response(response:200,description:"se lista los perfiles de tus chats" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: PerfilDTO::class))))]
    public function listarChats(int $id_perfil,Request $request, DtoConverters $converters,MensajeRepository $mensajeRepository, Utilidades $utilidades):JsonResponse
    {
        //Se obtiene la lista de perfiles de la BBDD
        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            $lista_chats = $mensajeRepository->findChats($id_perfil);
            //Se transforma a Json
            $lista_Json = array();
            //se devuelve el Json transformado
            foreach($lista_chats as $chat){
                $chatDTO = $converters-> perfilToDto($chat);
                $json = $utilidades->toJson($chatDTO, null);
                $lista_Json[] = json_decode($json);
            }
            return new JsonResponse($lista_Json, 200,[], false);
        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }


    }

    #[Route('api/mensaje/mandarMensaje', name: 'app_mensaje_mandarMensaje', methods: ['POST'])]
    #[OA\Tag(name: 'Mensajes')]
    #[Security(name: "apikey")]
    #[OA\RequestBody(description:"DTO del mensaje" ,required: true, content: new OA\JsonContent(ref: new Model(type:CrearMensajeDTO::class)))]
    public function mandarMensajes(Request $request,PerfilRepository $perfilRepository, DtoConverters $converters,MensajeRepository $mensajeRepository,Utilidades $utilidades):JsonResponse
    {
        //Se obtiene la lista de perfiles de la BBDD
        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            //Obtener Json del body
            $json  = json_decode($request->getContent(), true);
            //Obtenemos los parámetros del JSON
            $mensaje = $json['mensaje'];
            $fecha_envio = new \DateTime($json['fechaEnvio']);
            $tipo_mensaje = $json['tipoMensaje'];
            $imagen = $json['imagen'];
            $leido = $json['leido'];
            $emisor = $json['emisor'];
            $receptor = $json['receptor'];

            $mensajeNuevo = new Mensaje();
            $mensajeNuevo->setMensaje($mensaje);
            $mensajeNuevo->setTipoMensaje($tipo_mensaje);
            $mensajeNuevo->setFechaEnvio($fecha_envio);
            $mensajeNuevo->setImagen($imagen);
            $mensajeNuevo->setLeido($leido);
            $mensajeNuevo->setEmisor($perfilRepository->findOneBy(array('id'=>$emisor)));
            $mensajeNuevo->setReceptor($perfilRepository->findOneBy(array('id'=>$receptor)));

            $mensajeRepository->save($mensajeNuevo, true);

            return new JsonResponse('{mensaje enviado correctamente}', 200,[], false);
        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }


    }








}
