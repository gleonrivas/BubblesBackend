<?php

namespace ContainerKPMG08o;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_QYeS34AService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.qYeS34A' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.qYeS34A'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'rolEntityRepository' => ['privates', 'App\\Repository\\RolEntityRepository', 'getRolEntityRepositoryService', true],
            'utils' => ['privates', 'App\\Utilidades\\Utilidades', 'getUtilidadesService', true],
        ], [
            'rolEntityRepository' => 'App\\Repository\\RolEntityRepository',
            'utils' => 'App\\Utilidades\\Utilidades',
        ]);
    }
}
