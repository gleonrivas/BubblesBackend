<?php

namespace App\Controller;


use App\Entity\UsuarioEntity;
use App\Repository\UsuarioEntityRepository;
use App\Service\UsuarioService;
use App\Utilidades\Utilidades;
use App\Utilidades\UtilidadesUsuario;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

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
    public function listar(UsuarioEntityRepository $repository, Utilidades $utils):JsonResponse
    {
        $lista_usuarios = $repository->findAll();
        $lista_Json = json_encode($lista_usuarios);

        //$lista_Json = $utils->toJson($lista_usuarios);

        return new JsonResponse($lista_Json, 200,[], true);
    }



    #[Route('/usuario/crear', name: 'app_usuario_crear', methods: ['POST'])]
    public function crearUsuarioSiNoExiste(Request $request,UsuarioService $usuarioService, UtilidadesUsuario $utilidadesUsuario){

        $nuevoUsuario = $utilidadesUsuario->extraerUsuarioFromJSON($request);
        $usuarioService->guardarUsuario($nuevoUsuario);
    }
}
