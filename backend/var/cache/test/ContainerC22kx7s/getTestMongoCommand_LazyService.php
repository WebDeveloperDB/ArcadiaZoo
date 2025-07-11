<?php

namespace ContainerC22kx7s;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getTestMongoCommand_LazyService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private '.App\Command\TestMongoCommand.lazy' shared service.
     *
     * @return \Symfony\Component\Console\Command\LazyCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'console'.\DIRECTORY_SEPARATOR.'Command'.\DIRECTORY_SEPARATOR.'Command.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'console'.\DIRECTORY_SEPARATOR.'Command'.\DIRECTORY_SEPARATOR.'LazyCommand.php';

        return $container->privates['.App\\Command\\TestMongoCommand.lazy'] = new \Symfony\Component\Console\Command\LazyCommand('app:test-mongo', [], 'Test de la connexion à MongoDB et insertion d’un document.', false, #[\Closure(name: 'App\\Command\\TestMongoCommand')] fn (): \App\Command\TestMongoCommand => ($container->privates['App\\Command\\TestMongoCommand'] ?? $container->load('getTestMongoCommandService')));
    }
}
