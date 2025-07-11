<?php

namespace ContainerC22kx7s;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getNelmioApiDoc_Controller_SwaggerYamlService extends App_KernelTestDebugContainer
{
    /**
     * Gets the public 'nelmio_api_doc.controller.swagger_yaml' shared service.
     *
     * @return \Nelmio\ApiDocBundle\Controller\YamlDocumentationController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'nelmio'.\DIRECTORY_SEPARATOR.'api-doc-bundle'.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'Controller'.\DIRECTORY_SEPARATOR.'YamlDocumentationController.php';

        return $container->services['nelmio_api_doc.controller.swagger_yaml'] = new \Nelmio\ApiDocBundle\Controller\YamlDocumentationController(($container->services['nelmio_api_doc.render_docs'] ?? $container->load('getNelmioApiDoc_RenderDocsService')));
    }
}
