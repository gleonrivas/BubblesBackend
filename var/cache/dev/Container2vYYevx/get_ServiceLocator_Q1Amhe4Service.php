<?php

namespace Container2vYYevx;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_Q1Amhe4Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.q1Amhe4' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.q1Amhe4'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'repository' => ['privates', 'App\\Repository\\LikeRepository', 'getLikeRepositoryService', true],
            'utilidades' => ['privates', 'App\\Utilidades\\Utilidades', 'getUtilidadesService', true],
        ], [
            'repository' => 'App\\Repository\\LikeRepository',
            'utilidades' => 'App\\Utilidades\\Utilidades',
        ]);
    }
}
