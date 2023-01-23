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
    #[Route('/publicacion/listar/{id}', name: 'app_publicacaion_listar_usuario', methods: ['GET'])]
    public function listarPublicacionporUsuario(PublicacionRepository $repository,
                                                Utilidades $utilidades,  int $id): JsonResponse
    {
        //se obtiene el parametro
        $id_usuario = $id;


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


        $usuario = $repository->encontrarporId($json['id_usuario']);

        //CREAR NUEVA PUBLICACION A PARTIR DEL JSON
        $publicacionNueva = new Publicacion();
        $publicacionNueva->setTipoPublicacion($json['tipo_publicacion']);
        $publicacionNueva->setTexto($json['texto']);
        $publicacionNueva->setImagen($json['imagen']);
        $publicacionNueva->setTematica($json['tematica']);
        $publicacionNueva->setFechaPublicacion($json['fecha_publicacion']);
        $publicacionNueva->setActiva($json['activa']);
        $publicacionNueva->setIdUsuario($usuario);

        //GUARDAR
        $em = $this-> doctrine->getManager();
        $em->persist($publicacionNueva);
        $em-> flush();

        return new JsonResponse("{ mensaje: Publicacion creada correctamente }", 200, [], true);


    }
}


