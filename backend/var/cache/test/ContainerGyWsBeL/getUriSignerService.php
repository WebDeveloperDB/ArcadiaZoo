<?php

namespace ContainerGyWsBeL;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getUriSignerService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'uri_signer' shared service.
     *
     * @return \Symfony\Component\HttpFoundation\UriSigner
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'http-foundation'.\DIRECTORY_SEPARATOR.'UriSigner.php';

        return $container->privates['uri_signer'] = new \Symfony\Component\HttpFoundation\UriSigner($container->getEnv('APP_SECRET'));
    }
}
