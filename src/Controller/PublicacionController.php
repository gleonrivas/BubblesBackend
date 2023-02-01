<?php

namespace App\Controller;

use App\Controller\DTO\PublicacionDTO;
use App\Entity\Publicacion;
use App\Entity\Usuario;
use App\Repository\PerfilRepository;
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
        $lista_publicacion = $repository->findAll();
        $lista_dto_publicacion = [];
        foreach ($lista_publicacion as $publicacion) {
            $publicacionDTO = new PublicacionDTO(
                $publicacion->getTipoPublicacion(),
                $publicacion->getFechaPublicacion(),
                $publicacion->getTexto(),
                $publicacion->getImagen(),
                $publicacion->getTematica(),
                $publicacion->getActiva()
            );

            array_push($lista_dto_publicacion, $publicacionDTO);
        }

        $lista_Json = $utilidades->toJson($lista_dto_publicacion, null);
        return new JsonResponse($lista_Json, 200, [], true);
    }

    #[Route('/publicacion/listar/{id}', name: 'app_publicacaion_listar_usuario', methods: ['GET'])]
    public function listarPublicacionporPerfil(PublicacionRepository $repository,
                                               Utilidades            $utilidades, int $id): JsonResponse
    {
        //se obtiene el parametro
        $id_perfil = $id;


        $parametrosBusqueda = array(
            'id_perfil' => $id_perfil
        );
        //se obtiene la lista de publicacion
        $lista_publicacion = $repository->findBy($parametrosBusqueda);
        $lista_dto_publicacion = [];
        foreach ($lista_publicacion as $publicacion) {
            $publicacionDTO = new PublicacionDTO(
                $publicacion->getTipoPublicacion(),
                $publicacion->getFechaPublicacion(),
                $publicacion->getTexto(),
                $publicacion->getImagen(),
                $publicacion->getTematica(),
                $publicacion->getActiva()
            );

            array_push($lista_dto_publicacion, $publicacionDTO);
        }

        $lista_Json = $utilidades->toJson($lista_dto_publicacion, null);
        return new JsonResponse($lista_Json, 200, [], true);
    }

    #[Route('/publicacion/listar/activas/{id}', name: 'app_publicacaion_listar_activas', methods: ['GET'])]
    public function listarPublicacionporPerfilActivas(PublicacionRepository $repository,
                                                      Utilidades            $utilidades, int $id): JsonResponse
    {
        //se obtiene el parametro
        $id_perfil = $id;


        $parametrosBusqueda = array(
            'id_perfil' => $id_perfil,
            'activa' => true,
        );
        //se obtiene la lista de publicacion
        $lista_publicacion = $repository->findBy($parametrosBusqueda);
        if (count($lista_publicacion) == 0) {
            return new JsonResponse("{ mensaje: No existen publicaciones con esas características }", 200, [], true);
        } else {
            $lista_dto_publicacion = [];
            foreach ($lista_publicacion as $publicacion) {
                $publicacionDTO = new PublicacionDTO(
                    $publicacion->getTipoPublicacion(),
                    $publicacion->getFechaPublicacion(),
                    $publicacion->getTexto(),
                    $publicacion->getImagen(),
                    $publicacion->getTematica(),
                    $publicacion->getActiva()
                );

                array_push($lista_dto_publicacion, $publicacionDTO);
            }

            $lista_Json = $utilidades->toJson($lista_dto_publicacion, null);
            return new JsonResponse($lista_Json, 200, [], true);
        }
    }

    #[Route('/publicacion/listar/tematica/{tematica}', name: 'app_publicacaion_listar_tematica', methods: ['GET'])]
    public function listarPublicacionporTematica(PublicacionRepository $repository,
                                                 Utilidades            $utilidades, string $tematica): JsonResponse
    {
        //se obtiene el parametro
        $parametrosBusqueda = array(
            'tematica' => $tematica
        );
        //se obtiene la lista de publicacion
        $lista_publicacion = $repository->findBy($parametrosBusqueda);
        if (count($lista_publicacion) == 0) {
            return new JsonResponse("{ mensaje: No existen publicaciones con esas características }", 200, [], true);
        } else {
            $lista_dto_publicacion = [];
            foreach ($lista_publicacion as $publicacion) {
                $publicacionDTO = new PublicacionDTO(
                    $publicacion->getTipoPublicacion(),
                    $publicacion->getFechaPublicacion(),
                    $publicacion->getTexto(),
                    $publicacion->getImagen(),
                    $publicacion->getTematica(),
                    $publicacion->getActiva()
                );

                array_push($lista_dto_publicacion, $publicacionDTO);
            }

            $lista_Json = $utilidades->toJson($lista_dto_publicacion, null);
            return new JsonResponse($lista_Json, 200, [], true);
        }
    }

    #[Route('/publicacion/listar/tipo/{tipo}', name: 'app_publicacaion_listar_tipo', methods: ['GET'])]
    public function listarPublicacionporTipo(PublicacionRepository $repository,
                                             Utilidades            $utilidades, string $tipo): JsonResponse
    {
        //se obtiene el parametro
        $parametrosBusqueda = array(
            'tipo_publicacion' => $tipo
        );
        //se obtiene la lista de publicacion
        $lista_publicacion = $repository->findBy($parametrosBusqueda);
        if (count($lista_publicacion) == 0) {
            return new JsonResponse("{ mensaje: No existen publicaciones con esas características }", 200, [], true);
        } else {
            $lista_dto_publicacion = [];
            foreach ($lista_publicacion as $publicacion) {
                $publicacionDTO = new PublicacionDTO(
                    $publicacion->getTipoPublicacion(),
                    $publicacion->getFechaPublicacion(),
                    $publicacion->getTexto(),
                    $publicacion->getImagen(),
                    $publicacion->getTematica(),
                    $publicacion->getActiva()
                );

                array_push($lista_dto_publicacion, $publicacionDTO);
            }

            $lista_Json = $utilidades->toJson($lista_dto_publicacion, null);
            return new JsonResponse($lista_Json, 200, [], true);
        }

    }

    #[Route('/publicacion/guardar', name: 'app_publicacaion_crear', methods: ['POST'])]
    public function guardarPublicacion(Request               $request, PerfilRepository $repository,
                                       PublicacionRepository $publicacionRepository): JsonResponse
    {

        //Obtener Json del body
        $json = json_decode($request->getContent(), true);

        $id_perfil = $json['id_perfil'];
        $criterio = array('id' => $id_perfil);
        $perfiles = $repository->findBy($criterio);
        $perfil = $perfiles[0];
        $datetime = new \DateTime($json['fecha_publicacion']);

        //CREAR NUEVA PUBLICACION A PARTIR DEL JSON
        $publicacionNueva = new Publicacion();
        $publicacionNueva->setTipoPublicacion($json['tipo_publicacion']);
        $publicacionNueva->setTexto($json['texto']);
        $publicacionNueva->setImagen($json['imagen']);
        $publicacionNueva->setTematica($json['tematica']);
        $publicacionNueva->setFechaPublicacion($datetime);
        $publicacionNueva->setActiva($json['activa']);
        $publicacionNueva->setIdPerfil($perfil);

        //GUARDAR
        $publicacionRepository->save($publicacionNueva, true);

        return new JsonResponse("{ mensaje: Publicacion creada correctamente }", 200, [], true);

    }

    #[Route('/publicacion/eliminar/{id}', name: 'app_publicacaion_eliminar', methods: ['DELETE'])]
    public function eliminarPublicacion(PublicacionRepository $publicacionRepository, int $id): JsonResponse
    {
        $publicaciones = array('id' => $id);

        if ($publicacionRepository->findBy($publicaciones) == null) {
            return new JsonResponse("{ mensaje: La publicación no existe }", 200, [], true);
        } else {
            $listapublicaciones = $publicacionRepository->findBy($publicaciones);
            $publicacion = $listapublicaciones[0];
            //ELIMINAR
            $publicacionRepository->remove($publicacion, true);

            return new JsonResponse("{ mensaje: Publicacion eliminada correctamente }", 200, [], true);
        }
    }

    #[Route('/publicacion/editar', name: 'app_publicacaion_editar', methods: ['POST'])]
    public function editarPublicacion(Request               $request, PerfilRepository $repository,
                                      PublicacionRepository $publicacionRepository): JsonResponse
    {

        //Obtener Json del body
        $json = json_decode($request->getContent(), true);

        //buscar publicacion antigua
        $id = $json['id'];
        $publicaciones = array('id' => $id);
        $listapublicaciones = $publicacionRepository->findBy($publicaciones);
        if (count($listapublicaciones) == 0) {
            return new JsonResponse("{ mensaje: No existe la publicación }", 200, [], true);
        } else {
            $publicacionantigua = $listapublicaciones[0];

            //buscar usuario y cambiar formato fecha publicacion
            $id_perfil = $json['id_perfil'];
            $criterio = array('id' => $id_perfil);
            $perfiles = $repository->findBy($criterio);
            $perfil = $perfiles[0];

            $datetime = new \DateTime($json['fecha_publicacion']);

            //CREAR NUEVA PUBLICACION A PARTIR DEL JSON

            $publicacionantigua->setTipoPublicacion($json['tipo_publicacion']);
            $publicacionantigua->setTexto($json['texto']);
            $publicacionantigua->setImagen($json['imagen']);
            $publicacionantigua->setTematica($json['tematica']);
            $publicacionantigua->setFechaPublicacion($datetime);
            $publicacionantigua->setActiva($json['activa']);
            $publicacionantigua->setIdPerfil($perfil);

            //GUARDAR
            $publicacionRepository->save($publicacionantigua, true);

            return new JsonResponse("{ mensaje: Publicacion editada correctamente }", 200, [], true);
        }


    }

}
