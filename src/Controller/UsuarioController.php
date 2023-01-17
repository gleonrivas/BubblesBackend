<?php

namespace App\Controller;


use App\Repository\UsuarioEntityRepository;
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
    #[Route('/listarUsuarios', name: 'listar_usuario', methods: ['GET'])]
    public function listar(UsuarioEntityRepository $repository, Utilidades $utils): JsonResponse
    {
        $lista_usuarios = $repository->findAll();
        $lista_Json = $utils->toJson($lista_usuarios);

        return new  JsonResponse($lista_Json, 200,[], true);

    }
}
