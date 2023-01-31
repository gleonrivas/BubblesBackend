<?php

namespace App\Controller;

use App\Controller\DTO\PerfilDTO;
use App\Controller\DTO\UsuarioDTO;
use App\Repository\PerfilRepository;
use App\Repository\SeguidorRepository;
use App\Repository\UsuarioRepository;
use App\Utilidades\Utilidades;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

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
    #[Route('/seguidores/listar/{id}', name: 'app_seguidor', methods: ['GET'])]
    public function listarseguidoresporidusuario(PerfilRepository $perfilrepository,
                                                 SeguidorRepository $seguidorRepository,
                                                 int $id,Utilidades $utilidades): JsonResponse
    {
        //se obtiene de la tabla de seguidores, los que el principal sean el id del parametro

        $lista_seguidores= $seguidorRepository->findBy(['id_principal'=>$id]);
        if(count($lista_seguidores)==0){
            return new JsonResponse("{ mensaje: no tienes seguidores }", 200, [], true);
        }else{
            $lista_follower = [];
            foreach ($lista_seguidores as $value) {
                $id_follower = $value->getIdFollower();
                $criterio = array('id'=>$id_follower);
                $followers = $perfilrepository->findBy($criterio);
                $follower = $followers[0];
                $perfil = new PerfilDTO($follower->getId(), $follower->getDescripcion(), $follower->getUsername(),
                    $follower->getTipoCuenta(), $follower->getFotoPerfil());
                array_push($lista_follower, $perfil);

            }
            $lista_Json = $utilidades->toJson($lista_follower, null);
            return new JsonResponse($lista_Json,200, [], true);

        }




    }

    #[Route('/seguidos/listar/{id}', name: 'app_seguidores', methods: ['GET'])]
    public function listarseguidosporidusuario(PerfilRepository $perfilrepository,
                                                 SeguidorRepository $seguidorRepository,
                                                 int $id,Utilidades $utilidades): JsonResponse
    {
        //se obtiene de la tabla de seguidores, los que el principal sean el id del parametro

        $lista_seguidores= $seguidorRepository->findBy(['id_follower'=>$id]);

        if(count($lista_seguidores)==0){
            return new JsonResponse("{ mensaje: no sigues a nadie todavía }", 200, [], true);
        }else{
            $lista_follower = [];
            foreach ($lista_seguidores as $value) {
                $id_principal = $value->getIdPrincipal();
                $criterio = array('id'=>$id_principal);
                $followers = $perfilrepository->findBy($criterio);
                $follower = $followers[0];
                $perfil = new PerfilDTO($follower->getId(), $follower->getDescripcion(), $follower->getUsername(),
                    $follower->getTipoCuenta(), $follower->getFotoPerfil());
                array_push($lista_follower, $perfil);

            }


            $lista_Json = $utilidades->toJson($lista_follower, null);
            return new JsonResponse($lista_Json,200, [], true);
        }

    }

    #[Route('/seguidor/eliminar/{id}/{id_seguidor}', name: 'app_eliminar_seguidor', methods: ['DELETE'])]
    public function eliminarseguidor(SeguidorRepository $seguidorRepository, int $id, int $id_seguidor): JsonResponse
    {
        $criterioseguidor = array('id_principal'=>$id,
            'id_follower'=>$id_seguidor);
        $listaseguidores= $seguidorRepository->findBy($criterioseguidor);
        if(count($listaseguidores)==0){
            return new JsonResponse("{ mensaje: el usuario no te sigue}", 200, [], true);
        }else{
            $seguidor = $listaseguidores[0];

            //ELIMINAR
            $seguidorRepository->remove($seguidor,true);

            return new JsonResponse("{ mensaje: seguidor eliminado correctamente }", 200, [], true);
        }


    }

    #[Route('/seguido/eliminar/{id}/{id_seguido}', name: 'app_dejar_seguir', methods: ['DELETE'])]
    public function dejardeseguir(SeguidorRepository $seguidorRepository, int $id, int $id_seguido): JsonResponse
    {
        $criterioseguidor = array('id_follower'=>$id,
            'id_principal'=>$id_seguido);
        $listaseguidores= $seguidorRepository->findBy($criterioseguidor);

        if(count($listaseguidores)== 0){
            return new JsonResponse("{ mensaje:no sigues a ese usuario }", 200, [], true);
        }else{
            $seguidor = $listaseguidores[0];


            //ELIMINAR
            $seguidorRepository->remove($seguidor,true);

            return new JsonResponse("{ mensaje: has dejado de seguir a este usuario }", 200, [], true);
        }





    }
}
