<?php declare(strict_types=1);

namespace Lmc\CodingStandard\Sniffs\Naming;

use Lmc\CodingStandard\Sniffs\AbstractSniffTestCase;

class ClassNameSuffixByParentSniffTest extends AbstractSniffTestCase
{
    /**
     * @test
     * @dataProvider provideFixtures
     */
    public function shouldFixCode(string $fixtureFile, ?array $classSuffixes, array $expectedErrors): void
    {
        $sniff = $this->applyFixturesToSniff($fixtureFile);

        /** @var ClassNameSuffixByParentSniff $sniffInstance */
        $sniffInstance = reset($sniff->ruleset->sniffs);
        if ($classSuffixes !== null) {
            $sniffInstance->defaultParentClassToSuffixMap = $classSuffixes;
        }

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
            'wrong with default ruleset' => [
                __DIR__ . '/Fixtures/ClassNameSuffixByParentSniffTest/CommandWrong.php.inc',
                null,
                [5 => 'Class "WronglyNamed" should have suffix "Command" by parent class/interface'],
            ],
            'properly named with default ruleset' => [
                __DIR__ . '/Fixtures/ClassNameSuffixByParentSniffTest/CommandCorrect.php.inc',
                null,
                [],
            ],
            'wrong with custom ruleset' => [
                __DIR__ . '/Fixtures/ClassNameSuffixByParentSniffTest/CustomWrong.php.inc',
                ['ParentClass'],
                [3 => 'Class "WronglyNamed" should have suffix "ParentClass" by parent class/interface'],
            ],
            'properly named with custom ruleset' => [
                __DIR__ . '/Fixtures/ClassNameSuffixByParentSniffTest/CustomCorrect.php.inc',
                ['ParentClass'],
                [],
            ],
            'wrong with interface' => [
                __DIR__ . '/Fixtures/ClassNameSuffixByParentSniffTest/InterfaceWrong.php.inc',
                ['FooBarInterface'],
                [3 => 'Class "WronglyNamed" should have suffix "FooBar" by parent class/interface'],
            ],
            'properly named interface' => [
                __DIR__ . '/Fixtures/ClassNameSuffixByParentSniffTest/InterfaceCorrect.php.inc',
                ['FooBarInterface'],
                [],
            ],
            'wrong with abstract class' => [
                __DIR__ . '/Fixtures/ClassNameSuffixByParentSniffTest/AbstractWrong.php.inc',
                ['AbstractSomething'],
                [3 => 'Class "WronglyNamed" should have suffix "Something" by parent class/interface'],
            ],
            'properly with abstract class' => [
                __DIR__ . '/Fixtures/ClassNameSuffixByParentSniffTest/AbstractCorrect.php.inc',
                ['AbstractSomething'],
                [],
            ],
        ];
    }

    protected function getSniffFile(): string
    {
        return __DIR__ . '/../../../src/Sniffs/Naming/ClassNameSuffixByParentSniff.php';
    }
}
