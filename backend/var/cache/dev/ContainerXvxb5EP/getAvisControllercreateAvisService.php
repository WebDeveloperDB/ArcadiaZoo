<?php

namespace ContainerXvxb5EP;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getAvisControllercreateAvisService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.TWxDQA4.App\Controller\AvisController::createAvis()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.TWxDQA4.App\\Controller\\AvisController::createAvis()'] = (new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'em' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
        ], [
            'em' => '?',
        ]))->withContext('App\\Controller\\AvisController::createAvis()', $container);
    }
}
