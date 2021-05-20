<?php declare(strict_types=1);

use PhpCsFixer\Fixer\FunctionNotation\PhpdocToParamTypeFixer;
use PhpCsFixer\Fixer\FunctionNotation\PhpdocToPropertyTypeFixer;
use PhpCsFixer\Fixer\FunctionNotation\PhpdocToReturnTypeFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    // Takes `@var` annotation of non-mixed types and adjusts accordingly the property signature.
    $services->set(PhpdocToPropertyTypeFixer::class);
    // Takes `@param` annotations of non-mixed types and adjusts accordingly the function signature.
    $services->set(PhpdocToParamTypeFixer::class);
    // Takes `@return` annotation of non-mixed types and adjusts accordingly the function signature.
    $services->set(PhpdocToReturnTypeFixer::class);
};
