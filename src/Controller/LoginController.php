<?php

namespace App\Controller;

use App\Controller\DTO\LoginDTO;
use App\Entity\AccessToken;
use App\Entity\Usuario;
use App\Repository\AccessTokenRepository;
use App\Repository\UsuarioRepository;
use App\Utilidades\Utilidades;
use Doctrine\Persistence\ManagerRegistry;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

class LoginController extends AbstractController
{


    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this-> doctrine = $managerRegistry;
    }


    #[Route('/api/login', name: 'app_login', methods: ["POST"])]
    #[OA\Tag(name: 'Login')]
    #[OA\RequestBody(description: "Dto de autentificación", content: new OA\JsonContent(ref: new Model(type: LoginDTO::class)))]
    public function login(Request $request, Utilidades $utils, UsuarioRepository $usuarioRepository, AccessTokenRepository $accessTokenRepository): JsonResponse
    {

        //CARGAR REPOSITORIOS
        $em = $this-> doctrine->getManager();


        //Cargar datos del cuerpo
        $json_body = json_decode($request->getContent(), true);

        //Datos Usuario
        $email = $json_body["email"];
        $password = $json_body["password"];

        //Validar que los credenciales son correcto
        if($email != null and $password !=null){

            $user = $usuarioRepository->findOneBy(array("email"=> $email));

            if($user != null){
                $verify = $utils-> verify($password, $user->getContrasena());
                if($verify){

                    $token = $accessTokenRepository-> findAccessTokenValida($user);

                    if($token != null){
                        return $this->json([
                            'token' => $token->getToken()
                        ]);
                    }else{
                        $tokenNuevo = $utils->generateAccessToken($user, $accessTokenRepository);
                        return $this->json([
                            'token' => $tokenNuevo
                        ]);
                    }
                }else{
                    return $this->json([
                        'message' => "Contraseña no válida"
                    ], 401);
                }

            }
            return $this->json([
                'message' => "Usuario no válido"
            ], 401);


        }else{
            return $this->json([
                'message' => "No ha indicado usuario y contraseña" ,
            ]);

        }



    }

}
