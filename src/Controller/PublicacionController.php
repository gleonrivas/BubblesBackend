<?php

namespace App\Controller;

use App\Entity\Publicacion;
use App\Entity\Usuario;
use App\Repository\PublicacionRepository;
use App\Repository\UsuarioRepository;
use App\Utilidades\Utilidades;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
class PublicacionController extends AbstractController
{
    #[Route('/publicacion', name: 'app_publicacion')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Controller',
            'path' => 'src/Controller/PublicacionController.php'
        ]);

    }
    #[Route('/publicacion/listar', name: 'app_publicacaion', methods: ['GET'])]
    public function listarPublicacion(PublicacionRepository $repository, Utilidades $utilidades): JsonResponse
    {
        //se obtiene la lista de publicacion
        $lista_publicacion= $repository->findAll();

        $lista_Json = $utilidades->toJson($lista_publicacion);
        return new JsonResponse($lista_Json,200, [], true);
    }
    #[Route('/publicacion/usuario/listar', name: 'app_publicacaion_listar_usuario', methods: ['GET'])]
    public function listarPublicacionporUsuario(PublicacionRepository $repository,
                                                Utilidades $utilidades, Request $request): JsonResponse
    {
        //se obtiene el parametro
        $id_usuario = $request->query->get("id_usuario");


        $parametrosBusqueda = array(
            'id_usuario' => $id_usuario
        );
        //se obtiene la lista de publicacion
        $lista_publicacion= $repository->findBy($parametrosBusqueda);

        $lista_Json = $utilidades->toJson($lista_publicacion);
        return new JsonResponse($lista_Json,200,[], true);
    }

    #[Route('/publicacion/guardar', name: 'app_publicacaion_crear', methods: ['POST'])]
    public function guardarPublicacion(Request $request, UsuarioRepository $repository): JsonResponse
    {

        //Obtener Json del body
        $json  = json_decode($request->getContent(), true);

       //cambiar array Json al contenido del json
        $tipo_publicacion= "";
        $texto= "";
        $imagen= "";
        $tematica= "";
        $fecha_publi = date_create();
        $activa = true;
        $id_usuario= 0;


        if(is_array($json)){
            $tipo_publicacion = $json['tipo_publicacion'];
            $texto = $json['texto'];
            $imagen = $json['imagen'];
            $tematica= $json['tematica'];
            $fecha_publi= $json['fecha_publicacion'];
            $activa= $json['activa'];
            $id_usuario = $json['id_usuario'];


        }

        $usuario = new Usuario();

        //CREAR NUEVA PUBLICACION A PARTIR DEL JSON
        $publicacionNueva = new Publicacion();
        $publicacionNueva->setTipoPublicacion($tipo_publicacion);
        $publicacionNueva->setTexto($texto);
        $publicacionNueva->setImagen($imagen);
        $publicacionNueva->setTematica($tematica);
        $publicacionNueva->setFechaPublicacion($fecha_publi);
        $publicacionNueva->setActiva($activa);
        $publicacionNueva->setIdUsuario($usuario);

        //GUARDAR
        $em = $this-> doctrine->getManager();
        $em->persist($publicacionNueva);
        $em-> flush();

        return new JsonResponse("{ mensaje: Publicacion creada correctamente }", 200, [], true);


    }
}


