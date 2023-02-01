<?php

namespace App\Controller;

use App\Controller\DTO\PerfilDTO;
use App\Controller\DTO\PublicacionDTO;
use App\Repository\LikeRepository;
use App\Repository\PerfilRepository;
use App\Repository\PublicacionRepository;
use App\Utilidades\Utilidades;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

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

    #[Route('/like/listar/publicacion/{id_publicacion}', name: 'app_like_publicacion', methods: ['GET'])]
    public function listarlikesdePublicacion(LikeRepository $repository, PerfilRepository $perfilRepository,
                                            Utilidades $utilidades, int $id_publicacion): JsonResponse
    {
        //se obtiene la lista de perfiles que han dado like
        $criterio = array('id_publicacion'=> $id_publicacion);
        $lista_likes = $repository->findBy($criterio);
        if(count($lista_likes)==0){
            return new JsonResponse("{ mensaje: La publicacion no tiene likes }", 200, [], true);
        }else{
            $lista_dto_perfil = [];
            foreach ($lista_likes as $like) {
                $criterio2 = array('id'=> $like->getIdPerfil());
                $lista_perfiles = $perfilRepository->findBy($criterio2);
                foreach ($lista_perfiles as $perfil){
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

    }

    #[Route('/like/cantidad/publicacion/{id_publicacion}', name: 'app_like_cantidad_publicacion', methods: ['GET'])]
    public function cantidadlikesdePublicacion(LikeRepository $repository,
                                             Utilidades $utilidades, int $id_publicacion): JsonResponse
    {
        //se obtiene la lista de perfiles que han dado like
        $criterio = array('id_publicacion'=> $id_publicacion);
        $lista_likes = $repository->count($criterio);
        if($lista_likes==0){
            return new JsonResponse("{ mensaje: La publicacion no tiene likes }", 200, [], true);
        }else{

            $lista_Json = $utilidades->toJson($lista_likes, null);
            return new JsonResponse($lista_Json, 200, [], true);
        }

    }

    #[Route('/like/listar/comentario/{id_comentario}', name: 'app_like_comentario', methods: ['GET'])]
    public function listarlikesdeComentario(LikeRepository $repository, PerfilRepository $perfilRepository,
                                             Utilidades $utilidades, int $id_comentario): JsonResponse
    {
        //se obtiene la lista de perfiles que han dado like
        $criterio = array('id_comentario'=> $id_comentario);
        $lista_likes = $repository->findBy($criterio);
        if(count($lista_likes)==0){
            return new JsonResponse("{ mensaje: El comentario no tiene likes }", 200, [], true);
        }else{
            $lista_dto_perfil = [];
            foreach ($lista_likes as $like) {
                $criterio2 = array('id'=> $like->getIdPerfil());
                $lista_perfiles = $perfilRepository->findBy($criterio2);
                foreach ($lista_perfiles as $perfil){
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

    }

    #[Route('/like/cantidad/comentario/{id_comentario}', name: 'app_like_cantidad_comentario', methods: ['GET'])]
    public function cantidadlikesdeComentario(LikeRepository $repository,
                                               Utilidades $utilidades, int $id_comentario): JsonResponse
    {
        //se obtiene la lista de perfiles que han dado like
        $criterio = array('id_comentario'=> $id_comentario);
        $lista_likes = $repository->count($criterio);
        if($lista_likes==0){
            return new JsonResponse("{mensaje: La publicacion no tiene likes}", 200, [], true);
        }else{

            $lista_Json = $utilidades->toJson($lista_likes, null);
            return new JsonResponse($lista_Json, 200, [], true);
        }

    }

    #[Route('/like/eliminar/{id}', name: 'app_like_eliminar', methods: ['DELETE'])]
    public function eliminarlikepublicacion(LikeRepository $likeRepository, int $id): JsonResponse
    {
        $criterio = array('id' => $id);
        $listalikes = $likeRepository->findBy($criterio);
        $like = $listalikes[0];
        if(count($listalikes)==0){
            return new JsonResponse("{ mensaje: El like ya no existe }", 200, [], true);
        }else{
            //ELIMINAR
            $likeRepository->remove($like, true);

            return new JsonResponse("{ mensaje: Like eliminado correctamente }", 200, [], true);
        }

    }
}
