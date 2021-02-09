# LMC Coding Standard for PHP

[![Latest Stable Version](https://img.shields.io/packagist/v/lmc/coding-standard.svg?style=flat-square)](https://packagist.org/packages/lmc/coding-standard)

PHP coding standard used in [LMC](https://www.lmc.eu/en/) projects.

Standard is based on [PSR-2](https://www.php-fig.org/psr/psr-2/) and adds various checks to make sure the code is readable,
does follow the same conventions and does not contain common mistakes.

We use [EasyCodingStandard] to define and execute checks created for both [PHP-CS-Fixer] and [PHP_CodeSniffer].

## Installation

```bash
composer require --dev lmc/coding-standard
```

## Usage

1. Create `ecs.php` file in the root directory of your project and import the LMC code-style rules:

```php
<?php declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/vendor/lmc/coding-standard/ecs.php');
};
```

2. Run the check command (for `src/` and `tests/` directories):

```bash
vendor/bin/ecs check src/ tests/
```

3. Optionally we recommend adding this to `scripts` section of your `composer.json`:

```json
    "scripts": {
        "analyze": [
            "vendor/bin/ecs check src/ tests/ --ansi",
            "[... other scripts, like PHPStan etc.]"
        ],
        "fix": [
            "...",
            "vendor/bin/ecs check ./src/ ./tests/ --ansi --fix"
        ],
    }
```

Now you will be able to run the fix using `composer analyze` and execute automatic fixes with `composer fix`.

### Add custom checks or override default settings

On top of default code-style rules you are free to add any rules from [PHP-CS-Fixer] or [PHP_CodeSniffer].
If needed, you can also override some default settings.

Be aware you must add these settings **after** import of the base LMC code-style:

```php
<?php declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitTestAnnotationFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/vendor/lmc/coding-standard/ecs.php');

    $services = $containerConfigurator->services();

    // Enforce line-length to 120 characters
    $services->set(LineLengthSniff::class)
        ->property('absoluteLineLimit', 120);

    // Tests must have @test annotation
    $services->set(PhpUnitTestAnnotationFixer::class)
        ->call('configure', [['style' => 'annotation']]);
};
```

See [EasyCodingStandard docs](https://github.com/symplify/easy-coding-standard#configuration) for more configuration options.


### Exclude (skip) checks or files

You can configure your `ecs.php` to entirely skip some files, disable specific checks of suppress specific errors.

Unlike adding/modifying checks, skips must be added **before** import of the base LMC code-style.

```php
<?php declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\ForbiddenFunctionsSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(
        Option::SKIP,
        [
            // Ignore specific check only in specific files
            ForbiddenFunctionsSniff::class => [__DIR__ . '/src-tests/bootstrap.php'],
            // Disable check entirely
            ArrayDeclarationSniff::class,
            // Skip one file
            __DIR__ . '/file/to/be/skipped.php',
            // Skip entire directory
            __DIR__ . '/ignored/directory/*',
        ]
    );

    $containerConfigurator->import(__DIR__ . '/vendor/lmc/coding-standard/ecs.php');
};
```

See [EasyCodingStandard docs](https://github.com/symplify/easy-coding-standard#configuration) for more configuration options.

### IDE integration

For integration with PHPStorm etc. follow instructions in EasyCodingStandard [README](https://github.com/symplify/easy-coding-standard#your-ide-integration).

## Changelog
For latest changes see [CHANGELOG.md](CHANGELOG.md) file. We follow [Semantic Versioning](http://semver.org/).

## License
This library is open source software licensed under the [MIT license](LICENCE.md).

[PHP-CS-Fixer]: https://github.com/FriendsOfPHP/PHP-CS-Fixer
[PHP_CodeSniffer]: https://github.com/squizlabs/PHP_CodeSniffer
[EasyCodingStandard]: https://github.com/symplify/easy-coding-standard
