<?php declare(strict_types=1);

namespace Lmc\CodingStandard\Sniffs\Naming;

use Lmc\CodingStandard\Sniffs\AbstractSniffTestCase;

class AbstractClassNameSniffTest extends AbstractSniffTestCase
{
    /**
     * @test
     * @dataProvider provideFixtures
     */
    public function shouldFixCode(string $fixtureFile, array $expectedErrors): void
    {
        $sniff = $this->applyFixturesToSniff($fixtureFile);
        $sniff->process();

        $foundErrors = $sniff->getErrors();

        $this->assertErrors($expectedErrors, $foundErrors);
    }

    /**
     * @return array[]
     */
    public function provideFixtures(): array
    {
        return [
            'wrongly named' => [
                __DIR__ . '/Fixtures/AbstractClassNameSniffTest.wrong.php.inc',
                [
                    3 => 'Abstract class should have prefix "Abstract".',
                    13 => 'Abstract class should have prefix "Abstract".',
                ],
            ],
            'properly named' => [__DIR__ . '/Fixtures/AbstractClassNameSniffTest.correct.php.inc', []],
        ];
    }

    protected function getSniffFile(): string
    {
        return __DIR__ . '/../../../src/Sniffs/Naming/AbstractClassNameSniff.php';
    }
}
