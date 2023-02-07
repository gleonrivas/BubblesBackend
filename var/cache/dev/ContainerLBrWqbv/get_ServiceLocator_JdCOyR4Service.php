<?php

namespace ContainerLBrWqbv;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_JdCOyR4Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.jdCOyR4' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.jdCOyR4'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'publicacionRepository' => ['privates', 'App\\Repository\\PublicacionRepository', 'getPublicacionRepositoryService', true],
            'repository' => ['privates', 'App\\Repository\\PerfilRepository', 'getPerfilRepositoryService', true],
            'utilidades' => ['privates', 'App\\Utilidades\\Utilidades', 'getUtilidadesService', true],
        ], [
            'publicacionRepository' => 'App\\Repository\\PublicacionRepository',
            'repository' => 'App\\Repository\\PerfilRepository',
            'utilidades' => 'App\\Utilidades\\Utilidades',
        ]);
    }
}
