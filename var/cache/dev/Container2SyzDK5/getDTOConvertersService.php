<?php

namespace Container2SyzDK5;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDTOConvertersService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Controller\DTO\DTOConverters' shared autowired service.
     *
     * @return \App\Controller\DTO\DTOConverters
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'Controller'.\DIRECTORY_SEPARATOR.'DTO'.\DIRECTORY_SEPARATOR.'DTOConverters.php';

        return $container->privates['App\\Controller\\DTO\\DTOConverters'] = new \App\Controller\DTO\DTOConverters();
    }
}
