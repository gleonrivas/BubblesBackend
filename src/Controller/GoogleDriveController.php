<?php

namespace App\Controller;

use App\Controller\DTO\DTOConverters;
use App\Controller\DTO\PerfilDTO;
use App\Repository\PerfilRepository;
use App\Utilidades\Utilidades;
use Exception;
use Google\Auth\AccessToken;
use Google\Service\CloudNaturalLanguage\Token;
use http\Env\Response;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Google\Client;
use Google\Service\Drive;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class GoogleDriveController extends AbstractController
{

    //EL name del imput tiene que ser file
    #[Route('/google/drive/save', name: 'drive_create_folder', methods: ['POST'])]
    public function Subir_Archivo(): string
    {

        try {
            putenv('GOOGLE_APPLICATION_CREDENTIALS=../src/keys/bubbles-377817-2e196d93ff9e.json');
            $client = new Client();
            $client->useApplicationDefaultCredentials();
            $client->setScopes(['https://www.googleapis.com/auth/drive.file']);
            $nombre_tmp = $_FILES["file"]["tmp_name"];


            $file_path = $_FILES["file"]["tmp_name"];
            $file = new \Google_Service_Drive_DriveFile();
            $file->setName($file_path);
            $file->setParents(array('11Qac_Tl5JTPB1ahAvjHjP4DK-xP4jowV'));
            $file->setDescription('Archivo cargado desde PHP');
            $mimeType = $_FILES["file"]["type"];
            $file->setMimeType($mimeType);

            $service = new \Google_Service_Drive($client);
            $resultado = $service->files->create(
                $file,
                array(
                    'data'=> file_get_contents($file_path),
                    'mimeType'=> 'image/png',
                    'uploadType' => 'media'
                )
            );
            return printf($resultado->id);

        } catch (\Google_Service_Exception $gs){
            $mensaje = json_decode($gs->getMessage());
            printf($mensaje);
        }

        return printf('algo anda mal');

    }
}