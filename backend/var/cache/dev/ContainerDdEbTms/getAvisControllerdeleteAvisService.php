<?php

namespace ContainerDdEbTms;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getAvisControllerdeleteAvisService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.4BBdIOf.App\Controller\AvisController::deleteAvis()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.4BBdIOf.App\\Controller\\AvisController::deleteAvis()'] = ($container->privates['.service_locator.4BBdIOf'] ?? $container->load('get_ServiceLocator_4BBdIOfService'))->withContext('App\\Controller\\AvisController::deleteAvis()', $container);
    }
}
