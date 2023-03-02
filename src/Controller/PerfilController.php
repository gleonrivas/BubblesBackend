<?php

namespace App\Controller;

use App\Controller\DTO\CrearPerfilDTO;
use App\Controller\DTO\CrearUsuarioDTO;
use App\Controller\DTO\DTOConverters;
use App\Controller\DTO\EditarPerfilDTO;
use App\Controller\DTO\MensajeRespuestaDTO;
use App\Controller\DTO\PerfilDTO;
use App\Controller\DTO\UsuarioDTO;
use App\Entity\Perfil;
use App\Entity\Usuario;
use App\Repository\AccessTokenRepository;
use App\Repository\ComentarioRepository;
use App\Repository\LikeRepository;
use App\Repository\MensajeRepository;
use App\Repository\PerfilRepository;
use App\Repository\PublicacionRepository;
use App\Repository\RolEntityRepository;
use App\Repository\SeguidorRepository;
use App\Repository\UsuarioRepository;
use App\Utilidades\Utilidades;
use Doctrine\DBAL\Portability\Converter;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Google\Client;
use Google_Service_Drive_DriveFile;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

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
    #[Route('api/perfil/listar', name: 'app_perfil_listar', methods: ['GET'])]
    #[OA\Tag(name: 'Perfiles')]
    #[Security(name: "apikey")]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: PerfilDTO::class))))]
    public function listar(Request $request, DtoConverters $converters,PerfilRepository $perfilRepository, Utilidades $utilidades):JsonResponse
    {
        //Se obtiene la lista de perfiles de la BBDD
        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            $lista_perfiles = $perfilRepository->findAll();
            //Se transforma a Json
            $lista_Json = array();
            //se devuelve el Json transformado
            foreach($lista_perfiles as $perfil){
                $perfilDTO = $converters-> perfilToDto($perfil);
                $json = $utilidades->toJson($perfilDTO, null);
                $lista_Json[] = json_decode($json);
            }
            return new JsonResponse($lista_Json, 200,[], false);
        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }


    }

    #[Route('api/perfil/{id}', name: 'app_perfil_id', methods: ['GET'])]
    #[OA\Tag(name: 'Perfiles')]
    #[Security(name: "apikey")]
    #[OA\HeaderParameter(name: "apiKey", required: true)]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: PerfilDTO::class))))]
    public function perfilPorId(Request $request, DtoConverters $converters,int $id, PerfilRepository $perfilRepository, Utilidades $utilidades):JsonResponse
    {
        //Se obtiene la lista de perfiles de la BBDD
        if($utilidades->comprobarPermisos($request, "usuario"))
        {

            $criterio = array('id'=> $id);

            if($perfilRepository->findBy($criterio)==null){
                return new JsonResponse("{message: No existe el perfil}", 400,[], false);
            }else{
                $lista_perfiles = $perfilRepository->findBy($criterio);
                //Se transforma a Json
                $perfil = $lista_perfiles[0];

                $perfilDTO = new PerfilDTO();
                $perfilDTO->setId($perfil->getId());
                $perfilDTO->setFotoPerfil($perfil->getFotoPerfil());
                $perfilDTO->setUsername($perfil->getUsername());
                $perfilDTO->setDescripcion($perfil->getDescripcion());
                $perfilDTO->setTipoCuenta($perfil->getTipoCuenta());
                $json = $utilidades->toJson($perfilDTO, null);

                return new JsonResponse($json, 200, [], true);}

        }else{

            return new JsonResponse("{message: Unauthorized}", 401,[], false);
        }
    }

    #[Route('api/perfilesDeUsuario/{id}', name: 'app_perfiles_id_usuario', methods: ['GET'])]
    #[OA\Tag(name: 'Perfiles')]
    #[Security(name: "apikey")]
    #[OA\HeaderParameter(name: "apiKey", required: true)]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: PerfilDTO::class))))]
    public function perfilesPorIdUsuario(Request $request,int $id,DTOConverters $converters, PerfilRepository $perfilRepository, Utilidades $utilidades):JsonResponse
    {
        if($utilidades->comprobarPermisos($request, "usuario"))
            if($perfilRepository->findBy(['id_usuario'=>$id])==null || $perfilRepository->findBy(['id_usuario'=>$id])==0)
                return new JsonResponse("{message: No tiene ningún perfil}", 400,[], false); else{
                $lista_perfiles = $perfilRepository->findBy(['id_usuario'=>$id]);
                $lista_Json = [];
                foreach ($lista_perfiles as $perfil){
                    $json = $utilidades->toJson($converters->perfilToDto($perfil), null);
                    $lista_Json[] = json_decode($json);
                }
                return new JsonResponse($lista_Json, 200, [], false);} else{
            return new JsonResponse("{message: Unauthorized}", 401,[], false);}
    }


    #[Route('api/perfil/listar/{username}', name: 'app_perfil_listarPorNombre', methods: ['GET'])]
    #[OA\Tag(name: 'Perfiles')]
    #[Security(name: "apikey")]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: PerfilDTO::class))))]
    public function listarPorNombre(string $username,Request $request, DtoConverters $converters,PerfilRepository $perfilRepository, Utilidades $utilidades):JsonResponse
    {
        //Se obtiene la lista de perfiles de la BBDD
        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            $lista_perfiles = $perfilRepository->encontrarPorUsername($username);
            //Se transforma a Json
            $lista_Json = array();
            //se devuelve el Json transformado
            foreach ($lista_perfiles as $perfil){
                $perfilDTO = $converters-> perfilToDto($perfil);
                $json = $utilidades->toJson($perfilDTO, null);
                $lista_Json[] = json_decode($json);
            }

            return new JsonResponse($lista_Json, 200,[], false);
        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }

    }

    #[Route('api/perfil/listarPorUsuario/', name: 'app_perfil_listarPorUsuario', methods: ['GET'])]
    #[OA\Tag(name: 'Perfiles')]
    #[Security(name: "apikey")]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: PerfilDTO::class))))]
    public function listarPorUsuario(Request $request, DtoConverters $converters,PerfilRepository $perfilRepository, Utilidades $utilidades):JsonResponse
    {
        //Se obtiene la lista de perfiles de la BBDD
        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            $lista_perfiles = $perfilRepository->findBy(array('id_usuario'=>$utilidades->infoToken($request)->getId()));
            //Se transforma a Json
            $lista_Json = array();
            //se devuelve el Json transformado
            foreach($lista_perfiles as $perfil){
                $perfilDTO = $converters-> perfilToDto($perfil);
                $json = $utilidades->toJson($perfilDTO, null);
                $lista_Json[] = json_decode($json);
            }
            return new JsonResponse($lista_Json, 200,[], false);
        }else{
            $mensaje = new MensajeRespuestaDTO("mensaje: Unauthorized");

            $json = $utilidades->toJson($mensaje,null);
            return new JsonResponse($json, 200,[], true);
        }


    }
    #[Route('api/perfil/listarPorUsuarioId/{id}', name: 'app_perfil_listarPorIdUsuario', methods: ['GET'])]
    #[OA\Tag(name: 'Perfiles')]
    #[Security(name: "apikey")]
    #[OA\Response(response:200,description:"successful operation" ,content: new OA\JsonContent(type: "array", items: new OA\Items(ref:new Model(type: PerfilDTO::class))))]
    public function listarPorIdUsuario(Request $request, int $id,
                                       PerfilRepository $perfilRepository,
                                       Utilidades $utilidades):JsonResponse
    {
        //Se obtiene la lista de perfiles de la BBDD
        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            $lista_perfiles = $perfilRepository->findBy(array('id_usuario'=>$id));
            //Se transforma a Json
            //se devuelve el Json transformado
            $lista_perfiles_dto = [];
            foreach ($lista_perfiles as $perfil){
                $perfilDTO = new PerfilDTO();
                $perfilDTO->setId($perfil->getId());
                $perfilDTO->setFotoPerfil($perfil->getFotoPerfil());
                $perfilDTO->setDescripcion($perfil->getDescripcion());
                $perfilDTO->setUsername($perfil->getUsername());
                $perfilDTO->setTipoCuenta($perfil->getTipoCuenta());
                array_push($lista_perfiles_dto, $perfilDTO);
            }

            $lista_Json = $utilidades->toJson($lista_perfiles_dto, null);
            return new JsonResponse($lista_Json, 200, [], true);

        }else{
            $mensaje = new MensajeRespuestaDTO("mensaje: Unauthorized");

            $json = $utilidades->toJson($mensaje,null);
            return new JsonResponse($json, 401,[], true);
        }


    }

    #[Route('api/perfil/guardar', name: 'app_perfil_guardar', methods: ['POST'])]
    #[OA\Tag(name: 'Perfiles')]
    #[Security(name: "apikey")]
    #[OA\RequestBody(description:"DTO del perfil" ,required: true, content: new OA\JsonContent(ref: new Model(type:CrearPerfilDTO::class)))]
    #[OA\Response(response: 200,description: "Perfil creado correctamente")]
    #[OA\Response(response: 101,description: "No ha indicado los datos necesarios")]
    public function save(Utilidades $utilidades, Request $request, PerfilRepository $perfilRepository, UsuarioRepository $usuarioRepository): JsonResponse
    {


        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            $em = $this->doctrine->getManager();
            $json  = json_decode($request->getContent(), true);
            //Obtenemos los parámetros del JSON
            $username = $json['username'];
            $descripcion = $json['descripcion'];
            $tipo_cuenta = $json['tipoCuenta'];

            if (count($perfilRepository->encontrarPorUsername($username))==0){
                putenv('GOOGLE_APPLICATION_CREDENTIALS=../src/keys/bubbles-377817-2e196d93ff9e.json');
                $client = new Client();
                $client->useApplicationDefaultCredentials();
                $client->setScopes(['https://www.googleapis.com/auth/drive.file']);
                $service = new \Google_Service_Drive($client);


                $fileMetadata = new Google_Service_Drive_DriveFile(array(
                    'name' => $username,
                    'mimeType' => 'application/vnd.google-apps.folder'));
                $fileMetadata->setParents(array('11Qac_Tl5JTPB1ahAvjHjP4DK-xP4jowV'));
                $fileFolder = $service->files->create($fileMetadata, array(
                    'fields' => 'id'));
                $file_path = $json["file"];
                $file = new \Google_Service_Drive_DriveFile();
                $file->setName($username.'_imgPerfil');
                $file->setParents(array($fileFolder->getId()));
                $file->setDescription('Archivo cargado desde PHP');
                $mimeType = substr(explode(';', $json["file"])[0],5);
                $file->setMimeType($mimeType);




                $mimeType = substr(explode(';', $json["file"])[0],5);
                $resultado = $service->files->create(
                    $file,
                    array(
                        'data'=> file_get_contents($file_path),
                        'mimeType'=> $mimeType,
                        'uploadType' => 'media'
                    )
                );




                //GUARDAR
                $nuevoPerfil = new Perfil();
                $nuevoPerfil->setUsername($username);
                $nuevoPerfil->setFotoPerfil('https://drive.google.com/uc?id='.$resultado->getId());
                $nuevoPerfil->setTipoCuenta($tipo_cuenta);
                $nuevoPerfil->setDescripcion($descripcion);
                $nuevoPerfil->setCarpeta($fileFolder->getId());
                $nuevoPerfil->setIdUsuario($usuarioRepository->findOneBy(array('id'=>$utilidades->infoToken($request)->getId())));

                $perfilRepository->save($nuevoPerfil, true);

                return new JsonResponse("{ mensaje: Perfil creado correctamente }", 200, [], true);
            } else{
                return new JsonResponse("{ mensaje: Este username no esta disponible}", 200, [], true);
            }

        }else{

            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }



    }

    #[Route('api/perfil/editar', name: 'app_perfil_editar', methods: ['POST'])]
    #[OA\Tag(name: 'Perfiles')]
    #[Security(name: "apikey")]
    #[OA\RequestBody(description:"DTO del perfil" ,required: true, content: new OA\JsonContent(ref: new Model(type:EditarPerfilDTO::class)))]
    #[OA\Response(response: 200,description: "Perfil editado correctamente")]
    #[OA\Response(response: 101,description: "No ha indicado los datos del perfil")]
    public function editar(Request $request, PerfilRepository $perfilRepository, Utilidades $utilidades): JsonResponse
    {


        if($utilidades->comprobarPermisos($request, "usuario")) {
            //Obtener Json del body
            $json = json_decode($request->getContent(), true);
            //Obtenemos los parámetros del JSON
            $username = $json['username'];
            $descripcion = $json['descripcion'];
            $tipo_cuenta = $json['tipoCuenta'];
            $id_perfil = $json['id'];

            $perfilAntiguo = $perfilRepository->findOneBy(array('id'=>$id_perfil));
            if ($perfilAntiguo->getCarpeta()==null){
                putenv('GOOGLE_APPLICATION_CREDENTIALS=../src/keys/bubbles-377817-2e196d93ff9e.json');
                $client = new Client();
                $client->useApplicationDefaultCredentials();
                $client->setScopes(['https://www.googleapis.com/auth/drive.file']);
                $service = new \Google_Service_Drive($client);
                $fileMetadata = new Google_Service_Drive_DriveFile(array(
                    'name' => $username,
                    'mimeType' => 'application/vnd.google-apps.folder'));
                $fileMetadata->setParents(array('11Qac_Tl5JTPB1ahAvjHjP4DK-xP4jowV'));
                $fileFolder = $service->files->create($fileMetadata, array(
                    'fields' => 'id'));
                $file_path = $json["file"];
                $file = new \Google_Service_Drive_DriveFile();
                $file->setName($username . '_imgPerfil');
                $file->setParents(array($fileFolder->getId()));
                $file->setDescription('Archivo cargado desde PHP');
                $mimeType = substr(explode(';', $json["file"])[0], 5);
                $file->setMimeType($mimeType);
            }else{
                $file_path = $json["file"];
                $file = new \Google_Service_Drive_DriveFile();
                $file->setName($username);
                $file->setParents(array($perfilAntiguo->getCarpeta()));
                $file->setDescription('Archivo cargado desde PHP');
            }


            $mimeType = substr(explode(';', $json["file"])[0], 5);
            $resultado = $service->files->create(
                $file,
                array(
                    'data' => file_get_contents($file_path),
                    'mimeType' => $mimeType,
                    'uploadType' => 'media'
                )
            );

            $perfilRepository->editar($username, $descripcion, 'https://drive.google.com/uc?id='.$resultado->getId(), $tipo_cuenta, $perfilAntiguo->getId());

            return new JsonResponse("{ mensaje: Perfil editado correctamente }", 200, [], true);
        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }

    }

    #[Route('/api/perfil/eliminar/{id}', name: 'app_perfil_eliminar', methods: ['DELETE'])]
    #[OA\Tag(name: 'Perfiles')]
    #[Security(name: "apikey")]
    #[OA\Response(response: 200,description: "Perfil borrado correctamente")]
    #[OA\Response(response: 101,description: "No se ha borrado correctamente")]
    public function eliminar(Request $request,?int $id, PerfilRepository $perfilRepository, Utilidades $utilidades,
                             LikeRepository $likeRepository, ComentarioRepository $comentarioRepository,
                            MensajeRepository $mensajeRepository, SeguidorRepository $seguidorRepository,
                            PublicacionRepository $publicacionRepository):JsonResponse
    {

        if($utilidades->comprobarPermisos($request, "usuario"))
        {
            $perfilEncontrado = $perfilRepository->encontrarporId($id);

            putenv('GOOGLE_APPLICATION_CREDENTIALS=../src/keys/bubbles-377817-2e196d93ff9e.json');
            $client = new Client();
            $client->useApplicationDefaultCredentials();
            $client->setScopes(['https://www.googleapis.com/auth/drive.file']);
            $service = new \Google_Service_Drive($client);
            if ($perfilEncontrado->getCarpeta() != null){
                $service->files->delete($perfilEncontrado->getCarpeta());
            }
            $likeRepository->eliminarLikesPorIdPerfil($id);
            $comentarioRepository->eliminarComentariosPorIdPerfil($id);
            $mensajeRepository-> eliminarEmisorMensajesPorIdPerfil($id);
            $mensajeRepository->eliminarReceptorMensajesPorIdPerfil($id);
            $seguidorRepository->eliminarSeguidorPorIdPerfil($id);
            $seguidorRepository->eliminarSeguidoPorIdPerfil($id);
            $publicacionRepository->eliminarPublicacionPorIdPerfil($id);
            $perfilRepository->eliminarperfilPorIdPerfil($id);
            $mensaje = $utilidades->toJson("perfil eliminado correctamente", null);
            return new JsonResponse($mensaje, 200, [], true);


        }else{
            return new JsonResponse("{message: Unauthorized}", 200,[], false);
        }

    }

}
