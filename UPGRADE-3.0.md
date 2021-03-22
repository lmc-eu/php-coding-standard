# Upgrading from 2.x to 3.0

The main backward compatibility break in lmc/coding-standard version 3.0 is new PHP format used for
code-style configuration. However, the changes are mostly "mechanical" and most of them can be automated.

### 1. Update dependency in composer.json
In require-dev section change the version constraint:

```diff
-        "lmc/coding-standard": "^2.1",
+        "lmc/coding-standard": "^3.0",
```

Then run `composer update`.

### 2. Change your easy-coding-standard.yaml
Remove import section (otherwise the migration in step 3. won't work):
```diff
-imports:
-    - { resource: 'vendor/lmc/coding-standard/easy-coding-standard.yaml' }
```

### 3. Automatically migrate config from `easy-coding-standard.yaml` to `ecs.php`
Run following commands:

```sh
composer require symplify/config-transformer --dev
vendor/bin/config-transformer switch-format easy-coding-standard.yaml --input-format yaml --output-format php
mv easy-coding-standard.php ecs.php # rename to ecs.php
composer remove symplify/config-transformer --dev # the migration tool can now be removed again
```

### 4. Add import of the base `ecs.php` from lmc/coding-standard

Because of the nature of how ECS processes the configuration (which is, in fact, the behavior of underlying
symfony/dependency-injection), you must follow the order in which you add your customizations.

⚠️ **IMPORTANT:** In your `ecs.php` the import of the lmc/coding-standard must be placed  **after your own `SKIP` parameter**
(if you use it) but **before** your custom code-style adjustments (if you use any).

```diff
// ...
return static function (ContainerConfigurator $containerConfigurator): void {
    // Your skips - excluding fixers of paths must be placed BEFORE the import
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::SKIP, [__DIR__ . '/foo/bar']);

+    $containerConfigurator->import(__DIR__ . '/vendor/lmc/coding-standard/ecs.php');

    // Your code style customizations and overrides of the default code-style must be placed AFTER the import
    $services = $containerConfigurator->services();
    $services->set(PhpUnitExpectationFixer::class)
        ->call('configure', [['target' => '5.6']]);
};
```

### 5. Configuration updates

There are also few changes in configuration properties. The most notable is `skip` parameter,
which is used for all path and sniff exclusions. So values from previous `skip`, `exclude_files` should all be merged into `skip`.

```diff
+use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

-    $parameters->set('skip', [ForbiddenFunctionsSniff::class => ['src-tests/bootstrap.php']]);
-    $parameters->set('exclude_files', [__DIR__ . '/src/foo/bar.php']);
+    $parameters->set(
+        Option::SKIP,
+        [
+            ForbiddenFunctionsSniff::class => [__DIR__ . '/src-tests/bootstrap.php'],
+            __DIR__ . '/src/foo/bar.php',
+        ]
+    );

    $containerConfigurator->import(__DIR__ . '/vendor/lmc/coding-standard/ecs.php');
};
```

See [ECS documentation](https://github.com/symplify/easy-coding-standard/tree/master#configuration) for more configuration options.

### 6. Sanity check
Besides running your code style checks, you can ensure all predefined LMC checks are loaded as well, by running:

```sh
vendor/bin/ecs show
```

The result should end with something like:
```
 [OK] Loaded 164 checkers in total
```

(or some close number, depending on your custom code-style settings).
