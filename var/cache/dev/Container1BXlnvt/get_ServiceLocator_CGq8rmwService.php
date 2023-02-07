<?php

namespace Container1BXlnvt;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_CGq8rmwService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.CGq8rmw' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.CGq8rmw'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'accessTokenRepository' => ['privates', 'App\\Repository\\AccessTokenRepository', 'getAccessTokenRepositoryService', true],
            'usuarioRepository' => ['privates', 'App\\Repository\\UsuarioRepository', 'getUsuarioRepositoryService', true],
            'utils' => ['privates', 'App\\Utilidades\\Utilidades', 'getUtilidadesService', true],
        ], [
            'accessTokenRepository' => 'App\\Repository\\AccessTokenRepository',
            'usuarioRepository' => 'App\\Repository\\UsuarioRepository',
            'utils' => 'App\\Utilidades\\Utilidades',
        ]);
    }
}
