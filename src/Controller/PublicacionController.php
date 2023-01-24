<?php

namespace App\Controller;

use App\Controller\DTO\PublicacionDTO;
use App\Entity\Publicacion;
use App\Entity\Usuario;
use App\Repository\PublicacionRepository;
use App\Repository\UsuarioRepository;
use App\Utilidades\Utilidades;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

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
    public function guardarPublicacion( Request $request,
                                       UsuarioRepository $repository, PublicacionRepository $publicacionRepository): JsonResponse
    {


        //Obtener Json del body
        $json  = json_decode($request->getContent(), true);

        $id_usuario = $json['id_usuario'];
        $usuario = $repository->encontrarporId($id_usuario);
        $datetime = new \DateTime($json['fecha_publicacion']);

        //CREAR NUEVA PUBLICACION A PARTIR DEL JSON
        $publicacionNueva = new Publicacion();
        $publicacionNueva->setTipoPublicacion($json['tipo_publicacion']);
        $publicacionNueva->setTexto($json['texto']);
        $publicacionNueva->setImagen($json['imagen']);
        $publicacionNueva->setTematica($json['tematica']);
        $publicacionNueva->setFechaPublicacion($datetime);
        $publicacionNueva->setActiva($json['activa']);
        $publicacionNueva->setIdUsuario($usuario);



        //GUARDAR
        $publicacionRepository->save($publicacionNueva, true);


        return new JsonResponse("{ mensaje: Publicacion creada correctamente }", 200, [], true);

    }
}
