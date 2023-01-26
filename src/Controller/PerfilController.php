<?php

namespace App\Controller;

use App\Entity\Perfil;
use App\Entity\Usuario;
use App\Repository\AccessTokenRepository;
use App\Repository\PerfilRepository;
use App\Repository\RolEntityRepository;
use App\Repository\UsuarioRepository;
use App\Utilidades\Utilidades;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PerfilController extends AbstractController
{

    private ManagerRegistry $doctrine;
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this-> doctrine = $managerRegistry;
    }


    #[Route('/perfil', name: 'app_perfil')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PerfilController.php',
        ]);
    }

    #[Route('/perfil/guardar', name: 'app_perfil_guardar', methods: ['POST'])]
    public function save(Request $request, PerfilRepository $perfilRepository, UsuarioRepository $usuarioRepository): JsonResponse
    {

        $em = $this->doctrine->getManager();

        //Obtener Json del body
        $json  = json_decode($request->getContent(), true);
        //Obtenemos los parámetros del JSON
        $username = $json['username'];
        $descripcion = $json['descripcion'];
        $tipo_cuenta = $json['tipo_cuenta'];
        $foto_perfil = $json['foto_perfil'];
        $usuarioJson = $json['id_usuario'];
        $usuario = $usuarioRepository->encontrarporId($usuarioJson);

        //GUARDAR
        $nuevoPerfil = new Perfil();
        $nuevoPerfil->setUsername($username);
        $nuevoPerfil->setFotoPerfil($foto_perfil);
        $nuevoPerfil->setTipoCuenta($tipo_cuenta);
        $nuevoPerfil->setDescripcion($descripcion);
        $nuevoPerfil->setIdUsuario($usuario);

        $perfilRepository->save($nuevoPerfil, true);

        return new JsonResponse("{ mensaje: Perfil creado correctamente }", 200, [], true);

    }

}
