<?php

namespace ContainerKPMG08o;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_5NPK3LsService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.5NPK3Ls' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.5NPK3Ls'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'converters' => ['privates', 'App\\Controller\\DTO\\DTOConverters', 'getDTOConvertersService', true],
            'perfilRepository' => ['privates', 'App\\Repository\\PerfilRepository', 'getPerfilRepositoryService', true],
            'utilidades' => ['privates', 'App\\Utilidades\\Utilidades', 'getUtilidadesService', true],
        ], [
            'converters' => 'App\\Controller\\DTO\\DTOConverters',
            'perfilRepository' => 'App\\Repository\\PerfilRepository',
            'utilidades' => 'App\\Utilidades\\Utilidades',
        ]);
    }
}
