# LMC Coding Standard for PHP

PHP coding standard used in [LMC](https://www.lmc.eu/en/) projects.

Standard is based on [PSR-2](https://www.php-fig.org/psr/psr-2/) and adds various checks to make sure the code is readable,
does follow the same conventions and does not contain common mistakes.

We use [EasyCodingStandard] to define and execute checks created for both [PHP-CS-Fixer] and [PHP_CodeSniffer].

**🚧 Please be advised this package is currently under development and anything can change anytime.**

## Installation

```bash
composer require --dev lmc/coding-standard:dev-master symplify/easy-coding-standard:^4.0@alpha symplify/coding-standard:^4.0@alpha symplify/package-builder:^4.0@alpha symplify/token-runner:^4.0@alpha symplify/better-reflection-docblock:^4.0@alpha
```

ℹ️ Because we currently depend on `@alpha` version of [EasyCodingStandard], all of its `@alpha` dependencies must temporarily
also be explicitly required with their stability flag.

## Usage

1. Create `easy-coding-standard.yml` file in root directory of your project and import the LMC code-style rules:

```yaml
imports:
    - { resource: 'vendor/lmc/coding-standard/easy-coding-standard.yml' }
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

If you need to exclude some specific check, please refer to the [EasyCodingStandard documentation](https://github.com/Symplify/EasyCodingStandard#exclude-checkers).

If you want to exclude some specific file (or directory) from the checks, you can use `skip` parameter to do so (see [docs](https://github.com/Symplify/EasyCodingStandard#ignore-what-you-cant-fix)).
⚠️ However **if you define custom `skip` section in your `parameters`, it will overwrite all `skip` rules** from the [imported standard][easy-coding-standard.yml]
and re-enable various un-intended rules. Until this [ECS limitation](https://github.com/Symplify/Symplify/pull/697#issuecomment-373915457)
is resolved, the workaround is to redeclare the whole content of the skip section of the main [`easy-coding-standard.yml`][easy-coding-standard.yml] file.

## Changelog
For latest changes see [CHANGELOG.md](CHANGELOG.md) file. We follow [Semantic Versioning](http://semver.org/).

## License
This library is open source software licensed under the [MIT license](LICENCE.md).

[PHP-CS-Fixer]: https://github.com/FriendsOfPHP/PHP-CS-Fixer
[PHP_CodeSniffer]: https://github.com/squizlabs/PHP_CodeSniffer
[EasyCodingStandard]: https://github.com/Symplify/EasyCodingStandard
[easy-coding-standard.yml]: https://github.com/lmc-eu/php-coding-standard/blob/master/easy-coding-standard.yml
