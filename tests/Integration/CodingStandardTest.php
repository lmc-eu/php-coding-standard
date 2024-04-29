<?php declare(strict_types=1);

namespace Lmc\CodingStandard\Integration;

use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
class CodingStandardTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideFilesToFix
     */
    public function shouldFixFile(string $wrongFile, string $correctFile): void
    {
        // copy wrongFile to a new temporary file
        $fixtureFile = tempnam(sys_get_temp_dir(), 'ecs-test');
        if ($fixtureFile === false) {
            $this->fail('Could not create temporary file');
        }
        copy($wrongFile, $fixtureFile);

        shell_exec(
            __DIR__ . '/../../vendor/bin/ecs check --no-progress-bar --no-ansi --no-interaction --fix ' . $fixtureFile,
        );

        $this->assertStringEqualsFile($correctFile, file_get_contents($fixtureFile));
        unlink($fixtureFile);
    }

    public function provideFilesToFix(): array
    {
        return [
            'Basic' => [__DIR__ . '/Fixtures/Basic.wrong.php.inc', __DIR__ . '/Fixtures/Basic.correct.php.inc'],
            'NewPhpFeatures' => [
                __DIR__ . '/Fixtures/NewPhpFeatures.wrong.php.inc',
                __DIR__ . '/Fixtures/NewPhpFeatures.correct.php.inc',
            ],
        ];
    }
}
