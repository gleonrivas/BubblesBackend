<?php

namespace App\Controller;

use App\Controller\DTO\PerfilDTO;
use App\Controller\DTO\PublicacionDTO;
use App\Controller\DTO\UsuarioDTO;
use App\Repository\PerfilRepository;
use App\Repository\SeguidorRepository;
use App\Repository\UsuarioRepository;
use App\Utilidades\Utilidades;
use http\Env\Request;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;


class SeguidorController extends AbstractController
{
    #[Route('/seguidor', name: 'app_seguidor')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SeguidorController.php',
        ]);
    }

    #[Route('/api/seguidores/listar/{id}', name: 'app_seguidor', methods: ['GET'])]
    #[OA\Tag(name: 'Seguidores')]
    #[Security(name: "apikey")]
    #[OA\Response(response: 200, description: "successful operation", content: new OA\JsonContent(type: "array",
        items: new OA\Items(ref: new Model(type: PerfilDTO::class))))]
    public function listarseguidoresporidperfil(\Symfony\Component\HttpFoundation\Request $request, PerfilRepository $perfilrepository,
                                                 SeguidorRepository $seguidorRepository,
                                                 int                $id, Utilidades $utilidades): JsonResponse
    {
        //se obtiene de la tabla de seguidores, los que el principal sean el id del parametro
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            $lista_seguidores = $seguidorRepository->findBy(['id_principal' => $id]);
            if (count($lista_seguidores) == 0) {
                return new JsonResponse("{ mensaje: no tienes seguidores }", 200, [], true);
            } else {
                $lista_follower = [];
                foreach ($lista_seguidores as $value) {
                    $id_follower = $value->getIdFollower();
                    $criterio = array('id' => $id_follower);
                    $followers = $perfilrepository->findBy($criterio);
                    $follower = $followers[0];
                    $perfil = new PerfilDTO();
                    $perfil->setId($follower->getId());
                    $perfil->setDescripcion($follower->getDescripcion());
                    $perfil->setUsername($follower->getUsername());
                    $perfil->setTipoCuenta($follower->getTipoCuenta());
                    $perfil->setFotoPerfil($follower->getFotoPerfil());
                    array_push($lista_follower, $perfil);

                }
                $lista_Json = $utilidades->toJson($lista_follower, null);
                return new JsonResponse($lista_Json, 200, [], true);

            }

        } else {
            return new JsonResponse("{message: Unauthorized}", 200, [], false);
        }


    }

    #[Route('/api/seguidos/listar/{id}', name: 'app_seguidores', methods: ['GET'])]
    #[OA\Tag(name: 'Seguidores')]
    #[Security(name: "apikey")]
    #[OA\Response(response: 200, description: "successful operation", content: new OA\JsonContent(type: "array",
        items: new OA\Items(ref: new Model(type: PerfilDTO::class))))]
    public function listarseguidosporidusuario(\Symfony\Component\HttpFoundation\Request $request, PerfilRepository $perfilrepository,
                                               SeguidorRepository $seguidorRepository,
                                               int                $id, Utilidades $utilidades): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            //se obtiene de la tabla de seguidores, los que el principal sean el id del parametro

            $lista_seguidores = $seguidorRepository->findBy(['id_follower' => $id]);

            if (count($lista_seguidores) == 0) {
                return new JsonResponse("{ mensaje: no sigues a nadie todavía }", 200, [], true);
            } else {
                $lista_follower = [];
                foreach ($lista_seguidores as $value) {
                    $id_principal = $value->getIdPrincipal();
                    $criterio = array('id' => $id_principal);
                    $followers = $perfilrepository->findBy($criterio);
                    $follower = $followers[0];
                    $perfil = new PerfilDTO();
                    $perfil->setId($follower->getId());
                    $perfil->setDescripcion($follower->getDescripcion());
                    $perfil->setUsername($follower->getUsername());
                    $perfil->setTipoCuenta($follower->getTipoCuenta());
                    $perfil->setFotoPerfil($follower->getFotoPerfil());
                    array_push($lista_follower, $perfil);

                }


                $lista_Json = $utilidades->toJson($lista_follower, null);
                return new JsonResponse($lista_Json, 200, [], true);
            }
        } else {
            return new JsonResponse("{message: Unauthorized}", 200, [], false);
        }
    }

    #[Route('/api/seguidor/eliminar/{id}/{id_seguidor}', name: 'app_eliminar_seguidor', methods: ['DELETE'])]
    #[OA\Tag(name: 'Seguidores')]
    #[Security(name: "apikey")]
    #[OA\Response(response: 200, description:"El usuario no te sigue" )]
    #[OA\Response(response: 100, description: "Seguidor eliminado correctamente")]
    #[OA\Response(response: 101, description: "No ha indicado usario y contraseña")]
    public function eliminarseguidor(\Symfony\Component\HttpFoundation\Request $request, Utilidades $utilidades, SeguidorRepository $seguidorRepository, int $id, int $id_seguidor): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            $criterioseguidor = array('id_principal' => $id,
                'id_follower' => $id_seguidor);
            if ($seguidorRepository->findBy($criterioseguidor) == null) {
                return new JsonResponse("{ mensaje: el usuario no te sigue}", 200, [], true);
            } else {
                $listaseguidores = $seguidorRepository->findBy($criterioseguidor);
                $seguidor = $listaseguidores[0];

                //ELIMINAR
                $seguidorRepository->remove($seguidor, true);

                return new JsonResponse("{ mensaje: seguidor eliminado correctamente }", 200, [], true);
            }
        } else {
            return new JsonResponse("{message: Unauthorized}", 200, [], false);
        }

    }

    #[Route('/api/seguido/eliminar/{id}/{id_seguido}', name: 'app_dejar_seguir', methods: ['DELETE'])]
    #[OA\Tag(name: 'Seguidores')]
    #[Security(name: "apikey")]
    #[OA\Response(response: 200, description: "No sigues a ese perfil")]
    #[OA\Response(response: 100, description: "Has dejado de seguir a este perfil")]
    #[OA\Response(response: 101, description: "No ha indicado usario y contraseña")]
    public function dejardeseguir(\Symfony\Component\HttpFoundation\Request $request, Utilidades $utilidades, SeguidorRepository $seguidorRepository, int $id, int $id_seguido): JsonResponse
    {
        if ($utilidades->comprobarPermisos($request, "usuario")) {
            $criterioseguidor = array('id_follower' => $id,
                'id_principal' => $id_seguido);

            if ($seguidorRepository->findBy($criterioseguidor) == null) {
                return new JsonResponse("{ mensaje:no sigues a ese perfil }", 200, [], true);
            } else {
                $listaseguidores = $seguidorRepository->findBy($criterioseguidor);
                $seguidor = $listaseguidores[0];


                //ELIMINAR
                $seguidorRepository->remove($seguidor, true);

                return new JsonResponse("{ mensaje: has dejado de seguir a este perfil }", 200, [], true);
            }

        } else {
            return new JsonResponse("{message: Unauthorized}", 200, [], false);
        }
    }
}
