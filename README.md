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

1. Create `easy-coding-standard.yaml` file in root directory of your project and import the LMC code-style rules:

```yaml
imports:
    - { resource: 'vendor/lmc/coding-standard/easy-coding-standard.yaml' }
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
        ]
    }
```

### Exclude (skip) some checks or files

You can configure EasyCodingStandard via `parameters` section of your `easy-coding-standard.yaml` to:
 - exclude a specific file from all checks (via [`exclude_files`](https://github.com/Symplify/EasyCodingStandard#ignore-what-you-cant-fix))
 - skip specific check from some file(s) or directories (via [`skip`](https://github.com/Symplify/EasyCodingStandard#ignore-what-you-cant-fix))
 - disable whole check (via [`exclude_checkers`](https://github.com/Symplify/EasyCodingStandard#exclude-checkers))

## Changelog
For latest changes see [CHANGELOG.md](CHANGELOG.md) file. We follow [Semantic Versioning](http://semver.org/).

## License
This library is open source software licensed under the [MIT license](LICENCE.md).

[PHP-CS-Fixer]: https://github.com/FriendsOfPHP/PHP-CS-Fixer
[PHP_CodeSniffer]: https://github.com/squizlabs/PHP_CodeSniffer
[EasyCodingStandard]: https://github.com/Symplify/EasyCodingStandard
[easy-coding-standard.yml]: https://github.com/lmc-eu/php-coding-standard/blob/master/easy-coding-standard.yml
