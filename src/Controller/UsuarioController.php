<?php

namespace App\Controller;


use App\Repository\UsuarioRepository;
use App\Utilidades\Utilidades;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{

    #[Route('/usuario', name: 'app_usuario')]
    public function index(): JsonResponse
    {
       return $this->json([
           'message' => 'Controller',
           'path' => 'src/Controller/UsuarioController.php'
       ]);

    }


    #[Route('/usuario/listar', name: 'app_usuario_listar', methods: ['GET'])]
    public function listar(UsuarioRepository $repository, Utilidades $utils):JsonResponse
    {
        //Se obtiene la lista de usuarios de la BBDD
        $lista_usuarios = $repository->findAll();
        //Se transforma a Json
        $lista_Json = $utils->toJson($lista_usuarios);
        //se devuelve el Json transformado
        return new JsonResponse($lista_Json, 200,[], true);

    }
}
