<?php

namespace Container1BXlnvt;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getPublicacionControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\Controller\PublicacionController' shared autowired service.
     *
     * @return \App\Controller\PublicacionController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/PublicacionController.php';

        $container->services['App\\Controller\\PublicacionController'] = $instance = new \App\Controller\PublicacionController();

        $instance->setContainer(($container->privates['.service_locator.CshazM0'] ?? $container->load('get_ServiceLocator_CshazM0Service'))->withContext('App\\Controller\\PublicacionController', $container));

        return $instance;
    }
}
