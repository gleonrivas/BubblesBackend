<?php

namespace Container2SyzDK5;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_ICgUdJxService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.ICgUdJx' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.ICgUdJx'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'perfilRepository' => ['privates', 'App\\Repository\\PerfilRepository', 'getPerfilRepositoryService', true],
            'repository' => ['privates', 'App\\Repository\\LikeRepository', 'getLikeRepositoryService', true],
            'utilidades' => ['privates', 'App\\Utilidades\\Utilidades', 'getUtilidadesService', true],
        ], [
            'perfilRepository' => 'App\\Repository\\PerfilRepository',
            'repository' => 'App\\Repository\\LikeRepository',
            'utilidades' => 'App\\Utilidades\\Utilidades',
        ]);
    }
}
