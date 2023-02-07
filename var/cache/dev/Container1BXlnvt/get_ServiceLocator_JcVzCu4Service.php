<?php

namespace Container1BXlnvt;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_JcVzCu4Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.JcVzCu4' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.JcVzCu4'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'perfilRepository' => ['privates', 'App\\Repository\\PerfilRepository', 'getPerfilRepositoryService', true],
            'usuarioRepository' => ['privates', 'App\\Repository\\UsuarioRepository', 'getUsuarioRepositoryService', true],
            'utilidades' => ['privates', 'App\\Utilidades\\Utilidades', 'getUtilidadesService', true],
        ], [
            'perfilRepository' => 'App\\Repository\\PerfilRepository',
            'usuarioRepository' => 'App\\Repository\\UsuarioRepository',
            'utilidades' => 'App\\Utilidades\\Utilidades',
        ]);
    }
}
