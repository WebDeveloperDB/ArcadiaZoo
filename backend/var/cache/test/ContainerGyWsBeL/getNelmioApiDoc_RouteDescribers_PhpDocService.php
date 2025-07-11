<?php

namespace ContainerGyWsBeL;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getNelmioApiDoc_RouteDescribers_PhpDocService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'nelmio_api_doc.route_describers.php_doc' shared service.
     *
     * @return \Nelmio\ApiDocBundle\RouteDescriber\PhpDocDescriber
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'nelmio'.\DIRECTORY_SEPARATOR.'api-doc-bundle'.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'RouteDescriber'.\DIRECTORY_SEPARATOR.'RouteDescriberInterface.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'nelmio'.\DIRECTORY_SEPARATOR.'api-doc-bundle'.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'RouteDescriber'.\DIRECTORY_SEPARATOR.'RouteDescriberTrait.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'nelmio'.\DIRECTORY_SEPARATOR.'api-doc-bundle'.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'RouteDescriber'.\DIRECTORY_SEPARATOR.'PhpDocDescriber.php';

        return $container->privates['nelmio_api_doc.route_describers.php_doc'] = new \Nelmio\ApiDocBundle\RouteDescriber\PhpDocDescriber();
    }
}
