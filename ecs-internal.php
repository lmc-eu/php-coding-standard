<?php declare(strict_types=1);

use PhpCsFixer\Fixer\PhpUnit\PhpUnitTestAnnotationFixer;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

/**
 * Internal rules configuration for the lmc/coding-standard project itself
 */
return ECSConfig::configure()
    ->withPaths([__DIR__ . '/src', __DIR__ . '/tests'])
    ->withRootFiles()
    ->withSets(
        [
            __DIR__ . '/ecs.php',
        ],
    )
    ->withConfiguredRule(PhpUnitTestAnnotationFixer::class, ['style' => 'annotation'])
    ->withConfiguredRule(
        LineLengthFixer::class,
        ['line_length' => 120, 'break_long_lines' => true, 'inline_short_lines' => false],
    );
