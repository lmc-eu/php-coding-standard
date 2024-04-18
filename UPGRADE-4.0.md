# Upgrading from 3.x to 4.0

### 1. Update dependency in composer.json
In require-dev section change the version constraint:

```diff
-        "lmc/coding-standard": "^3.3",
+        "lmc/coding-standard": "^4.0",
```

Then run `composer update`.

### 2. Configuration updates

Configuration now uses ECSConfig class instead of ContainerConfigurator. Update your `ecs.php` to use the new configuration style:

```diff
-use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
-
-return static function (ContainerConfigurator $containerConfigurator): void {
+use Symplify\EasyCodingStandard\Config\ECSConfig;
+
+return ECSConfig::configure()
```

Rules are now set using `ECSConfig::configure()->withRules([])` or `ECSConfig::configure()->withConfiguredRule()` instead of `$services->set()`.
Skiping tests is now done using `ECSConfig::configure()->withSkip()` instead of `$parameters->set(Option::SKIP, ...)`.
Imports are now done using `ECSConfig::configure()->withSets()` instead of `$containerConfigurator->import()`.

See [ECS documentation](https://github.com/easy-coding-standard/easy-coding-standard/tree/main?tab=readme-ov-file#configure) for more configuration options
Examples of configurations can be seen [here](https://tomasvotruba.com/blog/new-in-ecs-simpler-config)

### 3. Remove imports of `ecs-7.4.php` and/or `ecs-8.0.php` from your `ecs.php`
```diff
    ->withSets(__DIR__ . '/vendor/lmc/coding-standard/ecs.php')
-    ->withSets(__DIR__ . '/vendor/lmc/coding-standard/ecs-7.4.php')
-    ->withSets(__DIR__ . '/vendor/lmc/coding-standard/ecs-8.0.php')
    ->withSets(__DIR__ . '/vendor/lmc/coding-standard/ecs-8.1.php')
```

### 4. Sanity check
Besides running your code style checks, you can ensure all predefined LMC checks are loaded as well, by running:

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
