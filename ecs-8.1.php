<?php declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/ecs-8.0.php');

    // class with constants only -> enum
    // @see https://www.php.net/releases/8.1/en.php#enumerations

    // readonly properties
    // @see https://www.php.net/releases/8.1/en.php#readonly_properties

    // first-class callable
    // @see https://www.php.net/releases/8.1/en.php#first_class_callable_syntax
};
