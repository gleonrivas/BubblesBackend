<?php

namespace Container2vYYevx;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getNelmioApiDoc_ModelDescribers_ObjectService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'nelmio_api_doc.model_describers.object' shared service.
     *
     * @return \Nelmio\ApiDocBundle\ModelDescriber\ObjectModelDescriber
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'nelmio'.\DIRECTORY_SEPARATOR.'api-doc-bundle'.\DIRECTORY_SEPARATOR.'ModelDescriber'.\DIRECTORY_SEPARATOR.'ModelDescriberInterface.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'nelmio'.\DIRECTORY_SEPARATOR.'api-doc-bundle'.\DIRECTORY_SEPARATOR.'Describer'.\DIRECTORY_SEPARATOR.'ModelRegistryAwareInterface.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'nelmio'.\DIRECTORY_SEPARATOR.'api-doc-bundle'.\DIRECTORY_SEPARATOR.'Describer'.\DIRECTORY_SEPARATOR.'ModelRegistryAwareTrait.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'nelmio'.\DIRECTORY_SEPARATOR.'api-doc-bundle'.\DIRECTORY_SEPARATOR.'ModelDescriber'.\DIRECTORY_SEPARATOR.'ApplyOpenApiDiscriminatorTrait.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'nelmio'.\DIRECTORY_SEPARATOR.'api-doc-bundle'.\DIRECTORY_SEPARATOR.'ModelDescriber'.\DIRECTORY_SEPARATOR.'ObjectModelDescriber.php';

        return $container->privates['nelmio_api_doc.model_describers.object'] = new \Nelmio\ApiDocBundle\ModelDescriber\ObjectModelDescriber(($container->privates['property_info'] ?? $container->load('getPropertyInfoService')), ($container->privates['annotations.reader'] ?? $container->load('getAnnotations_ReaderService')), new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['nelmio_api_doc.object_model.property_describers.array'] ?? $container->load('getNelmioApiDoc_ObjectModel_PropertyDescribers_ArrayService'));
            yield 1 => ($container->privates['nelmio_api_doc.object_model.property_describers.boolean'] ??= new \Nelmio\ApiDocBundle\PropertyDescriber\BooleanPropertyDescriber());
            yield 2 => ($container->privates['nelmio_api_doc.object_model.property_describers.float'] ??= new \Nelmio\ApiDocBundle\PropertyDescriber\FloatPropertyDescriber());
            yield 3 => ($container->privates['nelmio_api_doc.object_model.property_describers.integer'] ??= new \Nelmio\ApiDocBundle\PropertyDescriber\IntegerPropertyDescriber());
            yield 4 => ($container->privates['nelmio_api_doc.object_model.property_describers.string'] ??= new \Nelmio\ApiDocBundle\PropertyDescriber\StringPropertyDescriber());
            yield 5 => ($container->privates['nelmio_api_doc.object_model.property_describers.date_time'] ??= new \Nelmio\ApiDocBundle\PropertyDescriber\DateTimePropertyDescriber());
            yield 6 => ($container->privates['nelmio_api_doc.object_model.property_describers.object'] ??= new \Nelmio\ApiDocBundle\PropertyDescriber\ObjectPropertyDescriber());
            yield 7 => ($container->privates['nelmio_api_doc.object_model.property_describers.compound'] ?? $container->load('getNelmioApiDoc_ObjectModel_PropertyDescribers_CompoundService'));
        }, 8), [0 => 'json'], ($container->privates['serializer.name_converter.metadata_aware'] ?? $container->load('getSerializer_NameConverter_MetadataAwareService')), false, ($container->privates['serializer.mapping.class_metadata_factory'] ?? $container->load('getSerializer_Mapping_ClassMetadataFactoryService')));
    }
}
