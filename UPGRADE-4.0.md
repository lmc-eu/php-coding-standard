# Upgrading from 3.x to 4.0

### 1. Update dependency in composer.json
In require-dev section change the version constraint:

```diff
-        "lmc/coding-standard": "^3.3",
+        "lmc/coding-standard": "^4.0",
```

Then run `composer update`.

### 2. Configuration updates
Configuration now uses `ECSConfig` class instead of `ContainerConfigurator`.

Update your `ecs.php` to use the new configuration style:

```diff
-use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
+use Symplify\EasyCodingStandard\Config\ECSConfig;

-return static function (ContainerConfigurator $containerConfigurator): void {
+return ECSConfig::configure()
+    ->withSets([
+        __DIR__ . '/vendor/lmc/coding-standard/ecs.php',
+    ]);
    // ...
```

Now change the way you set rules, skip tests and import sets:

| Old Method                            | New Method                                                                                |
|---------------------------------------|-------------------------------------------------------------------------------------------|
| `$services->set()`                    | `ECSConfig::configure()->withRules([])` or `ECSConfig::configure()->withConfiguredRule()` |
| `$parameters->set(Option::SKIP, ...)` | `ECSConfig::configure()->withSkip()`                                                      |
| `$containerConfigurator->import()`    | `ECSConfig::configure()->withSets()`                                                      |

See [examples in Usage section of our README](https://github.com/lmc-eu/php-coding-standard?tab=readme-ov-file#usage)
or more configuration options in [ECS documentation](https://github.com/easy-coding-standard/easy-coding-standard/tree/main?tab=readme-ov-file#configure).

Some more reasoning and examples of configurations can also be seen [in ECS author blogpost](https://tomasvotruba.com/blog/new-in-ecs-simpler-config).

### 3. Remove imports of `ecs-7.4.php` and/or `ecs-8.0.php` from your `ecs.php`
```diff
    ->withSets(__DIR__ . '/vendor/lmc/coding-standard/ecs.php')
-    ->withSets(__DIR__ . '/vendor/lmc/coding-standard/ecs-7.4.php')
-    ->withSets(__DIR__ . '/vendor/lmc/coding-standard/ecs-8.0.php')
    ->withSets(__DIR__ . '/vendor/lmc/coding-standard/ecs-8.1.php')
```

### 4. Configure paths directly in ecs.php

Paths definition could now be included directly in `ecs.php` instead of repeating them on command line.

In `ecs.php`:
```php
// ...
return ECSConfig::configure()
    ->withPaths([__DIR__ . '/src', __DIR__ . '/tests']) // optionally add 'config' or other directories with PHP files
    ->withRootFiles() // to include ecs.php and all other php files in the root directory
// ...
```

Now you can remove the explicit paths definition from `composer.json`:
```diff
{
    "scripts": {
        "analyze": [
-            "vendor/bin/ecs check --ansi src/ tests/"
+            "vendor/bin/ecs check --ansi"
        ],
        "fix": [
-            "vendor/bin/ecs check --ansi --fix src/ tests/"
+            "vendor/bin/ecs check --ansi --fix"
        ]
    }
}
```

Or run directly from command line without a need of specifying them:
```bash
$ vendor/bin/ecs check --ansi src/ tests/ # old
$ vendor/bin/ecs check --ansi # new
```

### 5. Sanity check
Besides running your code style checks, you can ensure all predefined checks are loaded as well, by running:

```sh
vendor/bin/ecs list-checkers
```

The result should end with something like:
```
 41 checkers from PHP_CodeSniffer:
 ...
 147 checkers from PHP-CS-Fixer:
 ...
 2 checkers are skipped:
 ...
```

(or some close number, depending on your custom code-style settings).
