<?php

namespace ContainerKPMG08o;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_6rnaC2KService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.6rnaC2K' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.6rnaC2K'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'publicacionRepository' => ['privates', 'App\\Repository\\PublicacionRepository', 'getPublicacionRepositoryService', true],
            'utilidades' => ['privates', 'App\\Utilidades\\Utilidades', 'getUtilidadesService', true],
        ], [
            'publicacionRepository' => 'App\\Repository\\PublicacionRepository',
            'utilidades' => 'App\\Utilidades\\Utilidades',
        ]);
    }
}
