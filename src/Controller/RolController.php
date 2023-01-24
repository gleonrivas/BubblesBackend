<?php

namespace App\Controller;

use App\Entity\RolEntity;
use App\Repository\RolEntityRepository;
use App\Utilidades\Utilidades;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RolController extends AbstractController
{

    #[Route('/rol', name: 'app_rol')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Controller',
            'path' => 'src/Controller/RolController.php'
        ]);

    }


    #[Route('/rol/guardar', name: 'app_rol_guardar', methods: ['POST'])]
    public function saveRol(Request $request, Utilidades $utils, RolEntityRepository $rolEntityRepository): JsonResponse
    {

        //Obtener Json del body
        $json  = json_decode($request->getContent(), true);

        //Obtenemos los parámetros del JSON
        $nombre = $json['nombre'];
        $nuevoRol = new RolEntity();
        $nuevoRol->setNombre($nombre);

        //GUARDAR
        $rolEntityRepository->save($nuevoRol, true);

        return new JsonResponse("{ mensaje: Rol creado correctamente }", 200, [], true);

    }
}