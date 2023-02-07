<?php

namespace Container1BXlnvt;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_VQrjO0lService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.VQrjO0l' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.VQrjO0l'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'likerepository' => ['privates', 'App\\Repository\\LikeRepository', 'getLikeRepositoryService', true],
            'perfilRepository' => ['privates', 'App\\Repository\\PerfilRepository', 'getPerfilRepositoryService', true],
            'publicacionRepository' => ['privates', 'App\\Repository\\PublicacionRepository', 'getPublicacionRepositoryService', true],
            'utils' => ['privates', 'App\\Utilidades\\Utilidades', 'getUtilidadesService', true],
        ], [
            'likerepository' => 'App\\Repository\\LikeRepository',
            'perfilRepository' => 'App\\Repository\\PerfilRepository',
            'publicacionRepository' => 'App\\Repository\\PublicacionRepository',
            'utils' => 'App\\Utilidades\\Utilidades',
        ]);
    }
}
