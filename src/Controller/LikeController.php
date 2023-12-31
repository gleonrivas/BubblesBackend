<?php

namespace App\Controller;

use App\Controller\DTO\DTOConverters;
use App\Controller\DTO\PerfilDTO;
use App\Controller\DTO\PublicacionDTO;
use App\Entity\Like;
use App\Entity\Publicacion;
use App\Repository\ComentarioRepository;
use App\Repository\LikeRepository;
use App\Repository\PerfilRepository;
use App\Repository\PublicacionRepository;
use App\Utilidades\Utilidades;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\String_;
use phpDocumentor\Reflection\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use function Webmozart\Assert\Tests\StaticAnalysis\string;

class LikeController extends AbstractController
{
    #[Route('/like', name: 'app_like')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/LikeController.php',
        ]);
    }

    #[Route('/api/like/listar/publicacion/{id_publicacion}', name: 'app_like_publicacion', methods: ['GET'])]
    #[OA\Tag(name: 'Likes')]
    #[Security(name: "apikey")]
    #[OA\HeaderParameter(name: "apiKey", required: true)]
    #[OA\Response(response: 200, description: "successful operation", content: new OA\JsonContent(type: "array",
        items: new OA\Items(ref: new Model(type: PerfilDTO::class))))]
    public function listarlikesdePublicacion(Request    $request, LikeRepository $repository, PerfilRepository $perfilRepository,
                                             Utilidades $utilidades, int $id_publicacion): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            //se obtiene la lista de perfiles que han dado like
            $criterio = array('id_publicacion' => $id_publicacion);
            $lista_likes = $repository->findBy($criterio);
            if (count($lista_likes) == 0) {
                $lista_Json = $utilidades->toJson($lista_likes, null);
                return new JsonResponse($lista_Json, 200, [], true);
            } else {
                $lista_dto_perfil = [];
                foreach ($lista_likes as $like) {
                    $criterio2 = array('id' => $like->getIdPerfil());
                    $lista_perfiles = $perfilRepository->findBy($criterio2);
                    foreach ($lista_perfiles as $perfil) {
                        $perfilDTO = new PerfilDTO();
                        $perfilDTO->setId($perfil->getId());
                        $perfilDTO->setDescripcion($perfil->getDescripcion());
                        $perfilDTO->setUsername($perfil->getUsername());
                        $perfilDTO->setTipoCuenta($perfil->getTipoCuenta());
                        $perfilDTO->setFotoPerfil($perfil->getFotoPerfil());

                        array_push($lista_dto_perfil, $perfilDTO);
                    }


                }

                $lista_Json = $utilidades->toJson($lista_dto_perfil, null);
                return new JsonResponse($lista_Json, 200, [], true);
            }
        } else {
            return new JsonResponse("{message: Unauthorized}", 200, [], false);
        }

    }

    #[Route('/api/like/listar/tematicasporlike/{id_perfil}', name: 'app_lista_tematicas', methods: ['GET'])]
    #[OA\Tag(name: 'Likes')]
    #[Security(name: "apikey")]
    #[OA\HeaderParameter(name: "apiKey", required: true)]
    #[OA\Response(response: 200, description: "successful operation", content: new OA\JsonContent(type: Array_::class))]
    public function listartematica(Request $request, Utilidades $utilidades, PublicacionRepository $publicacionRepository,
                                   int     $id_perfil): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {

            //se obtiene la lista de perfiles que han dado like
            if ($publicacionRepository->tematicaPorLikes($id_perfil) != null) {
                $lista_tematica = $publicacionRepository->tematicaPorLikes($id_perfil);
                $lista_tematica = array_unique($lista_tematica, $sort_flags = SORT_STRING);
                $lista_Json = $utilidades->toJson($lista_tematica, null);
                return new JsonResponse($lista_Json, 200, [], true);
            } else {
                return new JsonResponse("{message: El perfil no prefiere ninguna temática}", 200, [], false);
            }

        } else {
            return new JsonResponse("{message: Unauthorized}", 401, [], false);
        }

    }

    #[Route('/api/like/cantidad/publicacion/{id_publicacion}', name: 'app_like_cantidad_publicacion', methods: ['GET'])]
    #[OA\Tag(name: 'Likes')]
    #[Security(name: "apikey")]
    #[OA\HeaderParameter(name: "apiKey", required: true)]
    #[OA\Response(response: 200, description: "successful operation", content: new OA\JsonContent(type: "array",
        items: new OA\Items(ref: new Model(type: Integer::class))))]
    public function cantidadlikesdePublicacion(Request    $request, LikeRepository $repository,
                                               Utilidades $utilidades, int $id_publicacion): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            //se obtiene la lista de perfiles que han dado like
            $criterio = array('id_publicacion' => $id_publicacion);
            $lista_likes = $repository->count($criterio);
            if ($lista_likes == 0) {
                return new JsonResponse("{ mensaje: La publicacion no tiene likes }", 200, [], true);
            } else {

                $lista_Json = $utilidades->toJson($lista_likes, null);
                return new JsonResponse($lista_Json, 200, [], true);
            }
        } else {
            return new JsonResponse("{message: Unauthorized}", 200, [], false);
        }

    }

    #[Route('/api/like/listar/comentario/{id_comentario}', name: 'app_like_comentario', methods: ['GET'])]
    #[OA\Tag(name: 'Likes')]
    #[Security(name: "apikey")]
    #[OA\HeaderParameter(name: "apiKey", required: true)]
    #[OA\Response(response: 200, description: "successful operation", content: new OA\JsonContent(type: "array",
        items: new OA\Items(ref: new Model(type: PerfilDTO::class))))]
    public function listarlikesdeComentario(Request    $request, LikeRepository $repository, PerfilRepository $perfilRepository,
                                            Utilidades $utilidades, int $id_comentario): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            //se obtiene la lista de perfiles que han dado like
            $criterio = array('id_comentario' => $id_comentario);
            $lista_likes = $repository->findBy($criterio);
            if (count($lista_likes) == 0) {
                return new JsonResponse("{ mensaje: El comentario no tiene likes }", 200, [], true);
            } else {
                $lista_dto_perfil = [];
                foreach ($lista_likes as $like) {
                    $criterio2 = array('id' => $like->getIdPerfil());
                    $lista_perfiles = $perfilRepository->findBy($criterio2);
                    foreach ($lista_perfiles as $perfil) {
                        $perfilDTO = new PerfilDTO();
                        $perfilDTO->setId($perfil->getId());
                        $perfilDTO->setDescripcion($perfil->getDescripcion());
                        $perfilDTO->setUsername($perfil->getUsername());
                        $perfilDTO->setTipoCuenta($perfil->getTipoCuenta());
                        $perfilDTO->setFotoPerfil($perfil->getFotoPerfil());

                        array_push($lista_dto_perfil, $perfilDTO);
                    }


                }

                $lista_Json = $utilidades->toJson($lista_dto_perfil, null);
                return new JsonResponse($lista_Json, 200, [], true);
            }
        } else {
            return new JsonResponse("{message: Unauthorized}", 200, [], false);
        }

    }

    #[Route('/api/like/cantidad/comentario/{id_comentario}', name: 'app_like_cantidad_comentario', methods: ['GET'])]
    #[OA\Tag(name: 'Likes')]
    #[Security(name: "apikey")]
    #[OA\HeaderParameter(name: "apiKey", required: true)]
    #[OA\Response(response: 200, description: "successful operation", content: new OA\JsonContent(type: "array",
        items: new OA\Items(ref: new Model(type: Integer::class))))]
    public function cantidadlikesdeComentario(Request    $request, LikeRepository $repository,
                                              Utilidades $utilidades, int $id_comentario): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            //se obtiene la lista de perfiles que han dado like
            $criterio = array('id_comentario' => $id_comentario);
            $lista_likes = $repository->count($criterio);
            if ($lista_likes == 0) {
                return new JsonResponse("{mensaje: La publicacion no tiene likes}", 200, [], true);
            } else {

                $lista_Json = $utilidades->toJson($lista_likes, null);
                return new JsonResponse($lista_Json, 200, [], true);
            }
        } else {
            return new JsonResponse("{message: Unauthorized}", 200, [], false);
        }

    }

    #[Route('/api/like/eliminar/{id}', name: 'app_like_eliminar', methods: ['DELETE'])]
    #[OA\Tag(name: 'Likes')]
    #[Security(name: "apikey")]
    #[OA\HeaderParameter(name: "apiKey", required: true)]
    #[OA\Response(response: 200, description: "Like eliminado correctamente")]
    #[OA\Response(response: 101, description: "El like ya no existe")]
    public function eliminarlike(Utilidades $utilidades, Request $request, LikeRepository $likeRepository, int $id): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            $criterio = array('id' => $id);
            if ($likeRepository->findBy($criterio) == null) {
                return new JsonResponse("{ mensaje: El like ya no existe }", 200, [], true);
            } else {
                $listalikes = $likeRepository->findBy($criterio);
                $like = $listalikes[0];
                //ELIMINAR
                $likeRepository->remove($like, true);

                return new JsonResponse("{ mensaje: Like eliminado correctamente }", 200, [], true);
            }
        } else {
            return new JsonResponse("{message: Unauthorized}", 200, [], false);
        }

    }

    #[Route('/api/likepublicacion/guardar/{id_publicacion}/{id_perfil}', name: 'app_likepublicacaion_crear', methods: ['POST'])]
    #[OA\Tag(name: 'Likes')]
    #[Security(name: "apikey")]
    #[OA\HeaderParameter(name: "apiKey", required: true)]
    #[OA\Response(response: 200, description: "Like creado correctamente")]
    #[OA\Response(response: 101, description: "No ha indicado usario y contraseña")]
    public function guardarLikePublicacion(Request               $request, int $id_publicacion, int $id_perfil,
                                           LikeRepository        $likerepository,
                                           PerfilRepository      $perfilRepository,
                                           Utilidades            $utils,
                                           PublicacionRepository $publicacionRepository): JsonResponse
    {
        if ($utils->comprobarPermisos($request, "usuario")) {
            //necesito el perfil
            $criterio = array('id' => $id_perfil);
            $perfiles = $perfilRepository->findBy($criterio);
            $perfil = $perfiles[0];

            //necesito la publicacion
            $criterio2 = array('id' => $id_publicacion);
            $publicaciones = $publicacionRepository->findBy($criterio2);
            $publicacion = $publicaciones[0];

            //crear un nuevo like
            $like = new Like();
            $like->setIdPublicacion($publicacion);
            $like->setNumeroLikes(1);
            $like->setIdComentario(null);
            $like->setIdPerfil($perfil);

            //GUARDAR
            $likerepository->save($like, true);
            $mensaje = $utils->toJson("mensaje: like creado correctamente", null);
            return new JsonResponse($mensaje, 200, [], true);
        } else {
            $mensaje = $utils->toJson("mensaje: Unauthorized", null);
            return new JsonResponse($mensaje, 401, [], false);
        }

    }

    #[Route('/api/likecomentario/guardar/{id_comentario}/{id_perfil}', name: 'app_likecomentario_crear', methods: ['POST'])]
    #[OA\Tag(name: 'Likes')]
    #[Security(name: "apikey")]
    #[OA\HeaderParameter(name: "apiKey", required: true)]
    #[OA\Response(response: 200, description: "Like creado correctamente")]
    #[OA\Response(response: 101, description: "No ha indicado usario y contraseña")]
    public function guardarLikeComentario(Request              $request, int $id_comentario, int $id_perfil,
                                          LikeRepository       $likerepository,
                                          PerfilRepository     $perfilRepository,
                                          Utilidades           $utils,
                                          ComentarioRepository $comentarioRepository): JsonResponse
    {
        if ($utils->comprobarPermisos($request, "usuario")) {

            //necesito el perfil
            $criterio = array('id' => $id_perfil);
            $perfiles = $perfilRepository->findBy($criterio);
            $perfil = $perfiles[0];

            //necesito el comentario
            $criterio2 = array('id' => $id_comentario);
            $comentarios = $comentarioRepository->findBy($criterio2);
            $comentario = $comentarios[0];

            //crear un nuevo like
            $like = new Like();
            $like->setIdPublicacion(null);
            $like->setNumeroLikes(1);
            $like->setIdComentario($comentario);
            $like->setIdPerfil($perfil);

            //GUARDAR
            $likerepository->save($like, true);

            return new JsonResponse("{ mensaje: like al comentario creado correctamente }", 200, [], true);

        } else {
            return new JsonResponse("{message: Unauthorized}", 200, [], false);
        }
    }

    #[Route('/api/likePublicacion/listar/{id_perfil}', name: 'app_likePublicacion_listar', methods: ['GET'])]
    #[OA\Tag(name: 'Likes')]
    #[Security(name: "apikey")]
    #[OA\Response(response: 200, description: "successful operation", content: new OA\JsonContent(type: "array", items: new OA\Items(ref: new Model(type: PublicacionDTO::class))))]
    public function listarPublicacion(int $id_perfil, Request $request, PublicacionRepository $repository, Utilidades $utilidades, DTOConverters $dtoConv): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            //se obtiene la lista de publicacion
            $lista_publicacion = $repository->findPublicacionesConLikes($id_perfil);
            $lista_dto_publicacion = [];
            foreach ($lista_publicacion as $publicacion) {

                $publicacionDTO = $dtoConv->publicacionToDTO($publicacion);

                $lista_dto_publicacion[] = $publicacionDTO;
            }

            $lista_Json = $utilidades->toJson($lista_dto_publicacion, null);
            return new JsonResponse($lista_Json, 200, [], true);
        } else {
            $mensaje = $utilidades->toJson("message:Unauthotired", null);
            return new JsonResponse($mensaje, 401, [], true);
        }

    }

    #[Route('/api/like/comprobar/like/{id_publicacion}/{id_perfil}', name: 'app_like_publicacion_perfil', methods: ['GET'])]
    #[OA\Tag(name: 'Likes')]
    #[Security(name: "apikey")]
    #[OA\HeaderParameter(name: "apiKey", required: true)]
    #[OA\Response(response: 200, description: "successful operation", content: new OA\JsonContent(type: "array",
        items: new OA\Items(ref: new Model(type: PerfilDTO::class))))]
    public function comprobarLike(Request    $request, LikeRepository $repository, PerfilRepository $perfilRepository,
                                  Utilidades $utilidades, int $id_perfil, int $id_publicacion): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            $criterio = array('id_publicacion' => $id_publicacion, 'id_perfil' => $id_perfil);
            $like = $repository->findOneBy($criterio);
            if ($like == null) {
                return new JsonResponse(false, 200, [], false);
            } else {

                return new JsonResponse(true, 200, [], false);
            }
        } else {
            $mensaje = $utilidades->toJson("{message: Unauthorized}", null);
            return new JsonResponse($mensaje, 401, [], false);
        }

    }

    #[Route('/api/like/eliminar/{id_perfil}/{id_publicacion}', name: 'app_like_eliminar', methods: ['DELETE'])]
    #[OA\Tag(name: 'Likes')]
    #[Security(name: "apikey")]
    #[OA\HeaderParameter(name: "apiKey", required: true)]
    #[OA\Response(response: 200, description: "Like eliminado correctamente")]
    #[OA\Response(response: 101, description: "El like ya no existe")]
    public function eliminarlikepublicacion(Utilidades $utilidades, Request $request, LikeRepository $likeRepository, int $id_perfil, int $id_publicacion): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            $criterio = array('id_perfil' => $id_perfil,
                'id_publicacion' => $id_publicacion);
            if ($likeRepository->findBy($criterio) == null) {
                $mensaje = $utilidades->toJson("{ mensaje: El like ya no existe }", null);
                return new JsonResponse($mensaje, 101, [], true);
            } else {
                //ELIMINAR
                $listalikes = $likeRepository->findBy($criterio);
                foreach ($listalikes as $like) {
                    $likeRepository->remove($like, true);
                }

                $mensaje = $utilidades->toJson("{ mensaje: Like eliminado correctamente }", null);
                return new JsonResponse($mensaje, 200, [], true);
            }
        } else {
            $mensaje = $utilidades->toJson("{message: Unauthorized}", null);
            return new JsonResponse($mensaje, 401, [], false);
        }

    }

}
