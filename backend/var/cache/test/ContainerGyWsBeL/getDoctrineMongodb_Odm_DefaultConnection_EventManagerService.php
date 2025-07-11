<?php

namespace ContainerGyWsBeL;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDoctrineMongodb_Odm_DefaultConnection_EventManagerService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'doctrine_mongodb.odm.default_connection.event_manager' shared service.
     *
     * @return \Symfony\Bridge\Doctrine\ContainerAwareEventManager
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['doctrine_mongodb.odm.default_connection.event_manager'] = new \Symfony\Bridge\Doctrine\ContainerAwareEventManager($container);
    }
}
