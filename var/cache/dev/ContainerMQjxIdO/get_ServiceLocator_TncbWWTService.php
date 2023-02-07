<?php

namespace ContainerMQjxIdO;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_TncbWWTService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.tncbWWT' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.tncbWWT'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'likeRepository' => ['privates', 'App\\Repository\\LikeRepository', 'getLikeRepositoryService', true],
            'utilidades' => ['privates', 'App\\Utilidades\\Utilidades', 'getUtilidadesService', true],
        ], [
            'likeRepository' => 'App\\Repository\\LikeRepository',
            'utilidades' => 'App\\Utilidades\\Utilidades',
        ]);
    }
}
