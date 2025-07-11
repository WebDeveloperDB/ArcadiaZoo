<?php

namespace ContainerGyWsBeL;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getMessenger_Middleware_RejectRedeliveredMessageMiddlewareService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'messenger.middleware.reject_redelivered_message_middleware' shared service.
     *
     * @return \Symfony\Component\Messenger\Middleware\RejectRedeliveredMessageMiddleware
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'messenger'.\DIRECTORY_SEPARATOR.'Middleware'.\DIRECTORY_SEPARATOR.'MiddlewareInterface.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'messenger'.\DIRECTORY_SEPARATOR.'Middleware'.\DIRECTORY_SEPARATOR.'RejectRedeliveredMessageMiddleware.php';

        return $container->privates['messenger.middleware.reject_redelivered_message_middleware'] = new \Symfony\Component\Messenger\Middleware\RejectRedeliveredMessageMiddleware();
    }
}
