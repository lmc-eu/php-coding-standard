<?php declare(strict_types=1);

use PhpCsFixer\Fixer\FunctionNotation\PhpdocToParamTypeFixer;
use PhpCsFixer\Fixer\FunctionNotation\PhpdocToPropertyTypeFixer;
use PhpCsFixer\Fixer\FunctionNotation\PhpdocToReturnTypeFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use SlevomatCodingStandard\Sniffs\Classes\RequireConstructorPropertyPromotionSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\RequireNullSafeObjectOperatorSniff;
use SlevomatCodingStandard\Sniffs\Functions\RequireTrailingCommaInCallSniff;
use SlevomatCodingStandard\Sniffs\Functions\RequireTrailingCommaInDeclarationSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\PropertyTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\UnionTypeHintFormatSniff;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    (function () use ($services): void {
        // Promote constructor properties
        // @see https://github.com/FriendsOfPHP/PHP-CS-Fixer/issues/5956
        $services->set(RequireConstructorPropertyPromotionSniff::class);

        // switch -> match
        // @see https://github.com/FriendsOfPHP/PHP-CS-Fixer/issues/5894

        // Require \Stringable interface in classes implementing __toString() method
        // > it may probably be a phpstan rule, more than cs rule - since it needs a class hierarchy to solve this
        // @see https://github.com/FriendsOfPHP/PHP-CS-Fixer/issues/6235

        // Takes `@var` annotation and adjusts accordingly the property signature.
        $services->set(PhpdocToPropertyTypeFixer::class);
        $services->set(PropertyTypeHintSniff::class);

        // Takes `@param` annotations and adjusts accordingly the function signature.
        $services->set(PhpdocToParamTypeFixer::class);
        $services->set(ParameterTypeHintSniff::class);

        // Takes `@return` annotation types and adjusts accordingly the function signature.
        $services->set(PhpdocToReturnTypeFixer::class);
        $services->set(ReturnTypeHintSniff::class);

        // Removes `@param` and `@return` tags that don't provide any useful information
        $services->set(NoSuperfluousPhpdocTagsFixer::class)
            ->call(
                'configure',
                [
                    [
                        'allow_mixed' => false, // allow `@mixed` annotations to be preserved
                        'allow_unused_params' => false, // whether param annotation without actual signature is allowed
                        'remove_inheritdoc' => true, // remove @inheritDoc tags
                    ],
                ]
            );

        // php docs annotation -> attributes #[...]
        // @see https://www.php.net/releases/8.0/en.php#attributes

        // Format union types
        $services->set(UnionTypeHintFormatSniff::class)
            ->property('withSpaces', 'no');

        // Multi-line arguments list in function/method declaration must have a trailing comma
        $services->set(RequireTrailingCommaInDeclarationSniff::class);
        // Multi-line arguments list in function/method call must have a trailing comma
        $services->set(RequireTrailingCommaInCallSniff::class);

        // Use `null-safe` operator `?->` where possible
        $services->set(RequireNullSafeObjectOperatorSniff::class);
    })();

    $parameters = $containerConfigurator->parameters();
    (function () use ($parameters): void {
        $parameters->set(
            Option::SKIP,
            [
                // Skip unwanted rules from PropertyTypeHintSniff
                PropertyTypeHintSniff::class . '.' . PropertyTypeHintSniff::CODE_MISSING_TRAVERSABLE_TYPE_HINT_SPECIFICATION => null,
                PropertyTypeHintSniff::class . '.' . PropertyTypeHintSniff::CODE_MISSING_ANY_TYPE_HINT => null,

                // Skip unwanted rules from ParameterTypeHintSniff
                ParameterTypeHintSniff::class . '.' . ParameterTypeHintSniff::CODE_MISSING_TRAVERSABLE_TYPE_HINT_SPECIFICATION => null,
                ParameterTypeHintSniff::class . '.' . ParameterTypeHintSniff::CODE_MISSING_ANY_TYPE_HINT => null,

                // Skip unwanted rules from ReturnTypeHintSniff
                ReturnTypeHintSniff::class . '.' . ReturnTypeHintSniff::CODE_MISSING_TRAVERSABLE_TYPE_HINT_SPECIFICATION => null,
                ReturnTypeHintSniff::class . '.' . ReturnTypeHintSniff::CODE_MISSING_ANY_TYPE_HINT => null,
            ]
        );
    })();
};
