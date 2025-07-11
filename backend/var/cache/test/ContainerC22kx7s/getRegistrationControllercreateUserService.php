<?php

namespace ContainerC22kx7s;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getRegistrationControllercreateUserService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private '.service_locator.KaWKm0J.App\Controller\RegistrationController::createUser()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.KaWKm0J.App\\Controller\\RegistrationController::createUser()'] = (new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'passwordHasher' => ['privates', 'security.user_password_hasher', 'getSecurity_UserPasswordHasherService', true],
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'serializer' => ['privates', 'serializer', 'getSerializerService', false],
        ], [
            'passwordHasher' => '?',
            'entityManager' => '?',
            'serializer' => '?',
        ]))->withContext('App\\Controller\\RegistrationController::createUser()', $container);
    }
}
