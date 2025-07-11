<?php

namespace ContainerGyWsBeL;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDoctrineMongodb_Odm_Command_LoadDataFixturesService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'doctrine_mongodb.odm.command.load_data_fixtures' shared service.
     *
     * @return \Doctrine\Bundle\MongoDBBundle\Command\LoadDataFixturesDoctrineODMCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'console'.\DIRECTORY_SEPARATOR.'Command'.\DIRECTORY_SEPARATOR.'Command.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'mongodb-odm-bundle'.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'Command'.\DIRECTORY_SEPARATOR.'DoctrineODMCommand.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'mongodb-odm-bundle'.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'Command'.\DIRECTORY_SEPARATOR.'LoadDataFixturesDoctrineODMCommand.php';

        $container->privates['doctrine_mongodb.odm.command.load_data_fixtures'] = $instance = new \Doctrine\Bundle\MongoDBBundle\Command\LoadDataFixturesDoctrineODMCommand(($container->services['doctrine_mongodb'] ?? self::getDoctrineMongodbService($container)), ($container->privates['doctrine_mongodb.odm.symfony.fixtures.loader'] ?? $container->load('getDoctrineMongodb_Odm_Symfony_Fixtures_LoaderService')));

        $instance->setName('doctrine:mongodb:fixtures:load');

        return $instance;
    }
}
