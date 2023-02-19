<?php

namespace App\Controller;

use App\Controller\DTO\CrearPublicacionDTO;
use App\Controller\DTO\CrearPublicacionDTOId;
use App\Controller\DTO\MensajeRespuestaDTO;
use App\Controller\DTO\PublicacionDTO;
use App\Controller\DTO\UsuarioDTO;
use App\Entity\Publicacion;
use App\Entity\Usuario;
use App\Repository\AccessTokenRepository;
use App\Repository\PerfilRepository;
use App\Repository\PublicacionRepository;
use App\Repository\UsuarioRepository;
use App\Utilidades\Utilidades;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use OpenApi\Attributes as OA;

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

    #[Route('/api/publicacion/listar', name: 'app_publicacaion', methods: ['GET'])]
    #[OA\Tag(name: 'Publicaciones')]
    #[Security(name: "apikey")]
    #[OA\Response(response: 200, description: "successful operation", content: new OA\JsonContent(type: "array",
        items: new OA\Items(ref: new Model(type: PublicacionDTO::class))))]
    public function listarPublicacion(Request $request, PublicacionRepository $repository, Utilidades $utilidades): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            //se obtiene la lista de publicacion
            $lista_publicacion = $repository->findAll();
            $lista_dto_publicacion = [];
            foreach ($lista_publicacion as $publicacion) {
                $publicacionDTO = new PublicacionDTO(
                    $publicacion->getId(),
                    $publicacion->getTipoPublicacion(),
                    $publicacion->getFechaPublicacion()->format('Y-m-d H:i:s'),
                    $publicacion->getTexto(),
                    $publicacion->getImagen(),
                    $publicacion->getTematica(),
                    $publicacion->getActiva(),
                    $publicacion->getIdPerfil()->getId()
                );

                array_push($lista_dto_publicacion, $publicacionDTO);
            }

            $lista_Json = $utilidades->toJson($lista_dto_publicacion, null);
            return new JsonResponse($lista_Json, 200, [], true);
        } else {
            $mensaje = new MensajeRespuestaDTO("mensaje: Unauthorized");

            $json = $utilidades->toJson($mensaje,null);
            return new JsonResponse($json, 401, [], true);
        }

    }

    #[Route('/api/publicacion/listar/{id}', name: 'app_publicacaion_listar_usuario', methods: ['GET'])]
    #[OA\Tag(name: 'Publicaciones')]
    #[Security(name: "apikey")]
    #[OA\Response(response: 200, description: "successful operation", content: new OA\JsonContent(type: "array",
        items: new OA\Items(ref: new Model(type: PublicacionDTO::class))))]
    public function listarPublicacionporPerfil(Request    $request, PublicacionRepository $repository,
                                               Utilidades $utilidades, int $id): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
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
                    $publicacion->getId(),
                    $publicacion->getTipoPublicacion(),
                    $publicacion->getFechaPublicacion()->format('Y-m-d H:i:s'),
                    $publicacion->getTexto(),
                    $publicacion->getImagen(),
                    $publicacion->getTematica(),
                    $publicacion->getActiva(),
                    $publicacion->getIdPerfil()->getId()
                );

                array_push($lista_dto_publicacion, $publicacionDTO);
            }

            $lista_Json = $utilidades->toJson($lista_dto_publicacion, null);
            return new JsonResponse($lista_Json, 200, [], true);
        } else {
            $mensaje = new MensajeRespuestaDTO("mensaje: Unauthorized");

            $json = $utilidades->toJson($mensaje,null);
            return new JsonResponse($json, 401, [], true);
        }
    }

    #[Route('/api/publicacion/listar/activas/{id}', name: 'app_publicacaion_listar_activas', methods: ['GET'])]
    #[OA\Tag(name: 'Publicaciones')]
    #[Security(name: "apikey")]
    #[OA\Response(response: 200, description: "successful operation", content: new OA\JsonContent(type: "array",
        items: new OA\Items(ref: new Model(type: PublicacionDTO::class))))]
    public function listarPublicacionporPerfilActivas(Request    $request, PublicacionRepository $repository,
                                                      Utilidades $utilidades, int $id): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            //se obtiene el parametro
            $id_perfil = $id;


            $parametrosBusqueda = array(
                'id_perfil' => $id_perfil,
                'activa' => true,
            );
            //se obtiene la lista de publicacion
            $lista_publicacion = $repository->findBy($parametrosBusqueda);
            if (count($lista_publicacion) == 0) {
                $mensaje = new MensajeRespuestaDTO("mensaje: No existen publicaciones con esas características");

                $json = $utilidades->toJson($mensaje,null);
                return new JsonResponse($json, 200, [], true);
            } else {
                $lista_dto_publicacion = [];
                foreach ($lista_publicacion as $publicacion) {
                    $publicacionDTO = new PublicacionDTO(
                        $publicacion->getId(),
                        $publicacion->getTipoPublicacion(),
                        $publicacion->getFechaPublicacion()->format('Y-m-d H:i:s'),
                        $publicacion->getTexto(),
                        $publicacion->getImagen(),
                        $publicacion->getTematica(),
                        $publicacion->getActiva(),
                        $publicacion->getIdPerfil()->getId()
                    );

                    array_push($lista_dto_publicacion, $publicacionDTO);
                }

                $lista_Json = $utilidades->toJson($lista_dto_publicacion, null);
                return new JsonResponse($lista_Json, 200, [], true);
            }
        } else {
            $mensaje = new MensajeRespuestaDTO("mensaje: Unauthorized");

            $json = $utilidades->toJson($mensaje,null);
            return new JsonResponse($json, 401, [], true);
        }
    }

    #[Route('/api/publicacion/listar/tematica/{tematica}', name: 'app_publicacaion_listar_tematica', methods: ['GET'])]
    #[OA\Tag(name: 'Publicaciones')]
    #[Security(name: "apikey")]
    #[OA\Response(response: 200, description: "successful operation", content: new OA\JsonContent(type: "array",
        items: new OA\Items(ref: new Model(type: PublicacionDTO::class))))]
    public function listarPublicacionporTematica(Request    $request, PublicacionRepository $repository,
                                                 Utilidades $utilidades, string $tematica): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            //se obtiene el parametro
            $parametrosBusqueda = array(
                'tematica' => $tematica
            );
            //se obtiene la lista de publicacion
            $lista_publicacion = $repository->findBy($parametrosBusqueda);
            if (count($lista_publicacion) == 0) {
                $mensaje = new MensajeRespuestaDTO("mensaje: No existen publicaciones con esas características");

                $json = $utilidades->toJson($mensaje,null);
                return new JsonResponse($json, 200, [], true);
            } else {
                $lista_dto_publicacion = [];
                foreach ($lista_publicacion as $publicacion) {
                    $publicacionDTO = new PublicacionDTO(
                        $publicacion->getId(),
                        $publicacion->getTipoPublicacion(),
                        $publicacion->getFechaPublicacion()->format('Y-m-d H:i:s'),
                        $publicacion->getTexto(),
                        $publicacion->getImagen(),
                        $publicacion->getTematica(),
                        $publicacion->getActiva(),
                        $publicacion->getIdPerfil()->getId()
                    );

                    array_push($lista_dto_publicacion, $publicacionDTO);
                }

                $lista_Json = $utilidades->toJson($lista_dto_publicacion, null);
                return new JsonResponse($lista_Json, 200, [], true);
            }
        } else {
            $mensaje = new MensajeRespuestaDTO("mensaje: Unauthorized");

            $json = $utilidades->toJson($mensaje,null);
            return new JsonResponse($json, 401, [], true);
        }
    }

    #[Route('/api/publicacion/listar/tipo/{tipo}', name: 'app_publicacaion_listar_tipo', methods: ['GET'])]
    #[OA\Tag(name: 'Publicaciones')]
    #[Security(name: "apikey")]
    #[OA\Response(response: 200, description: "successful operation", content: new OA\JsonContent(type: "array",
        items: new OA\Items(ref: new Model(type: PublicacionDTO::class))))]
    public function listarPublicacionporTipo(Request    $request, PublicacionRepository $repository,
                                             Utilidades $utilidades, string $tipo): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            //se obtiene el parametro
            $parametrosBusqueda = array(
                'tipo_publicacion' => $tipo
            );
            //se obtiene la lista de publicacion
            $lista_publicacion = $repository->findBy($parametrosBusqueda);
            if (count($lista_publicacion) == 0) {
                $mensaje = new MensajeRespuestaDTO("mensaje: No existen publicaciones con esas características");

                $json = $utilidades->toJson($mensaje,null);
                return new JsonResponse($json, 200, [], true);
            } else {
                $lista_dto_publicacion = [];
                foreach ($lista_publicacion as $publicacion) {
                    $publicacionDTO = new PublicacionDTO(
                        $publicacion->getId(),
                        $publicacion->getTipoPublicacion(),
                        $publicacion->getFechaPublicacion()->format('Y-m-d H:i:s'),
                        $publicacion->getTexto(),
                        $publicacion->getImagen(),
                        $publicacion->getTematica(),
                        $publicacion->getActiva(),
                        $publicacion->getIdPerfil()->getId()
                    );

                    array_push($lista_dto_publicacion, $publicacionDTO);
                }

                $lista_Json = $utilidades->toJson($lista_dto_publicacion, null);
                return new JsonResponse($lista_Json, 200, [], true);
            }
        } else {
            $mensaje = new MensajeRespuestaDTO("mensaje: Unauthorized");

            $json = $utilidades->toJson($mensaje,null);
            return new JsonResponse($json, 401, [], true);
        }
    }

    #[Route('/api/publicacion/guardar', name: 'app_publicacaion_crear', methods: ['POST'])]
    #[OA\Tag(name: 'Publicaciones')]
    #[Security(name: "apikey")]
    #[OA\RequestBody(description: "clase Publicacion", required: true, content: new OA\JsonContent(ref: new Model(type: CrearPublicacionDTO::class)))]
    #[OA\Response(response: 200, description: "Publicacion creada correctamente")]
    #[OA\Response(response: 101, description: "No ha indicado usario y contraseña")]
    public function guardarPublicacion(Request $request, Utilidades $utilidades, PerfilRepository $repository,
                                       PublicacionRepository $publicacionRepository): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            //Obtener Json del body
            $json = json_decode($request->getContent(), true);

            $id_perfil = $json['idPerfil'];
            $criterio = array('id' => $id_perfil);
            $perfiles = $repository->findBy($criterio);
            $perfil = $perfiles[0];
            $datetime = new \DateTime($json['fechaPublicacion']);

            //CREAR NUEVA PUBLICACION A PARTIR DEL JSON
            $publicacionNueva = new Publicacion();
            $publicacionNueva->setTipoPublicacion($json['tipoPublicacion']);
            $publicacionNueva->setTexto($json['texto']);
            $publicacionNueva->setImagen($json['imagen']);
            $publicacionNueva->setTematica($json['tematica']);
            $publicacionNueva->setFechaPublicacion($datetime);
            $publicacionNueva->setActiva($json['activa']);
            $publicacionNueva->setIdPerfil($perfil);

            //GUARDAR
            $publicacionRepository->save($publicacionNueva, true);

            $mensaje = new MensajeRespuestaDTO("mensaje: Publicacion creada correctamente");

            $json = $utilidades->toJson($mensaje,null);

            return new JsonResponse($json, 200, [], true);
        } else {
            $mensaje = new MensajeRespuestaDTO("mensaje: Unauthorized");

            $json = $utilidades->toJson($mensaje,null);
            return new JsonResponse($json, 401, [], true);
        }
    }

    #[Route('/api/publicacion/eliminar/{id}', name: 'app_publicacaion_eliminar', methods: ['DELETE'])]
    #[OA\Tag(name: 'Publicaciones')]
    #[Security(name: "apikey")]
    #[OA\Response(response: 200, description: "Publicacion eliminada correctamente")]
    #[OA\Response(response: 100, description: "La publicacion no existe")]
    #[OA\Response(response: 101, description: "No ha indicado usario y contraseña")]
    public function eliminarPublicacion(Request $request, Utilidades $utilidades, PublicacionRepository $publicacionRepository, int $id): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            $publicaciones = array('id' => $id);

            if ($publicacionRepository->findBy($publicaciones) == null) {
                return new JsonResponse("{ mensaje: La publicación no existe }", 200, [], true);
            } else {
                $listapublicaciones = $publicacionRepository->findBy($publicaciones);
                $publicacion = $listapublicaciones[0];
                //ELIMINAR
                $publicacionRepository->remove($publicacion, true);

                $mensaje = new MensajeRespuestaDTO("mensaje: Publicacion eliminada correctamente");

                $json = $utilidades->toJson($mensaje,null);

                return new JsonResponse($json, 200, [], true);
            }
        } else {
            $mensaje = new MensajeRespuestaDTO("mensaje: Unauthorized");

            $json = $utilidades->toJson($mensaje,null);
            return new JsonResponse($json, 401, [], true);
        }
    }

    #[Route('/api/publicacion/editar', name: 'app_publicacaion_editar', methods: ['POST'])]
    #[OA\Tag(name: 'Publicaciones')]
    #[Security(name: "apikey")]
    #[OA\RequestBody(description: "clase Publicacion", required: true, content: new OA\JsonContent(ref: new Model(type: CrearPublicacionDTOId::class)))]
    #[OA\Response(response: 200, description: "Publicacion editada correctamente")]
    #[OA\Response(response: 101, description: "No existe la publicacion")]
    #[OA\Response(response: 100, description: "No ha indicado usario y contraseña")]
    public function editarPublicacion(Utilidades $utilidades, Request $request, PerfilRepository $repository,
                                      PublicacionRepository $publicacionRepository): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            //Obtener Json del body
            $json = json_decode($request->getContent(), true);

            //buscar publicacion antigua
            $id = $json['id'];
            $publicaciones = array('id' => $id);
            if ($publicacionRepository->findBy($publicaciones) == null) {
                $mensaje = new MensajeRespuestaDTO("mensaje: No existe la publicación");

                $json = $utilidades->toJson($mensaje,null);
                return new JsonResponse($json, 200, [], true);
            } else {
                $listapublicaciones = $publicacionRepository->findBy($publicaciones);
                $publicacionantigua = $listapublicaciones[0];

                //buscar usuario y cambiar formato fecha publicacion
                $id_perfil = $json['idPerfil'];
                $criterio = array('id' => $id_perfil);
                $perfiles = $repository->findBy($criterio);
                $perfil = $perfiles[0];

                $datetime = new \DateTime($json['fechaPublicacion']);

                //CREAR NUEVA PUBLICACION A PARTIR DEL JSON

                $publicacionantigua->setTipoPublicacion($json['tipoPublicacion']);
                $publicacionantigua->setTexto($json['texto']);
                $publicacionantigua->setImagen($json['imagen']);
                $publicacionantigua->setTematica($json['tematica']);
                $publicacionantigua->setFechaPublicacion($datetime);
                $publicacionantigua->setActiva($json['activa']);
                $publicacionantigua->setIdPerfil($perfil);

                //GUARDAR
                $publicacionRepository->save($publicacionantigua, true);

                $mensaje = new MensajeRespuestaDTO("mensaje: Pubicación editada correctamente");

                $json = $utilidades->toJson($mensaje,null);

                return new JsonResponse($json, 200, [], true);
            }

        } else {
            $mensaje = new MensajeRespuestaDTO("mensaje: Unauthorized");

            $json = $utilidades->toJson($mensaje,null);
            return new JsonResponse($json, 401, [], true);
        }
    }

    #[Route('/api/publicacion/{id_publicacion}', name: 'app_publicacaion_id', methods: ['GET'])]
    #[OA\Tag(name: 'Publicaciones')]
    #[Security(name: "apikey")]
    #[OA\HeaderParameter(name: "apiKey", required: true)]
    #[OA\Response(response: 200, description: "successful operation", content: new OA\JsonContent(type: "array",
        items: new OA\Items(ref: new Model(type: PublicacionDTO::class))))]
    public function obtenerPublicacion(Request $request, PublicacionRepository $publicacionRepository, Utilidades $utilidades, int $id_publicacion): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            //se obtiene la lista de publicacion
            $repo = $publicacionRepository->find(['id'=>$id_publicacion]);

            $publicacionDTO = new PublicacionDTO(
                $repo->getId(),
                $repo->getTipoPublicacion(),
                $repo->getFechaPublicacion()->format('Y-m-d H:i:s'),
                $repo->getTexto(),
                $repo->getImagen(),
                $repo->getTematica(),
                $repo->getActiva(),
                $repo->getIdPerfil()->getId()
            );


            return new JsonResponse($utilidades->toJson($publicacionDTO, null), 200, [], true);
        } else {
            return new JsonResponse("{message: Unauthorized}", 401, [], false);
        }

    }

}
