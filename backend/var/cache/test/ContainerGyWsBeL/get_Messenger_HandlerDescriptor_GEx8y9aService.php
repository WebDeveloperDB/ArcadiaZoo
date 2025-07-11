<?php

namespace ContainerGyWsBeL;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_Messenger_HandlerDescriptor_GEx8y9aService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private '.messenger.handler_descriptor.gEx8y9a' shared service.
     *
     * @return \Symfony\Component\Messenger\Handler\HandlerDescriptor
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'messenger'.\DIRECTORY_SEPARATOR.'Handler'.\DIRECTORY_SEPARATOR.'HandlerDescriptor.php';

        $a = ($container->privates['chatter.messenger.chat_handler'] ?? $container->load('getChatter_Messenger_ChatHandlerService'));

        if (isset($container->privates['.messenger.handler_descriptor.gEx8y9a'])) {
            return $container->privates['.messenger.handler_descriptor.gEx8y9a'];
        }

        return $container->privates['.messenger.handler_descriptor.gEx8y9a'] = new \Symfony\Component\Messenger\Handler\HandlerDescriptor($a, []);
    }
}
