<?php

namespace ContainerGyWsBeL;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getConsultationControllerincrementConsultationService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private '.service_locator.F1jaNar.App\Controller\ConsultationController::incrementConsultation()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.F1jaNar.App\\Controller\\ConsultationController::incrementConsultation()'] = ($container->privates['.service_locator.F1jaNar'] ?? $container->load('get_ServiceLocator_F1jaNarService'))->withContext('App\\Controller\\ConsultationController::incrementConsultation()', $container);
    }
}
