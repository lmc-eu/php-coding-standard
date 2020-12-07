<?php declare(strict_types=1);

namespace Lmc\CodingStandard\Fixer;

use PhpCsFixer\Tokenizer\Tokens;
use PHPUnit\Framework\TestCase;

class SpecifyArgSeparatorFixerTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideFiles
     */
    public function shouldFixCode(string $inputFile, string $expectedOutputFile): void
    {
        $fixer = new SpecifyArgSeparatorFixer();
        $fileInfo = new \SplFileInfo(__DIR__ . '/Fixtures/' . $inputFile);
        $tokens = Tokens::fromCode(file_get_contents($fileInfo->getRealPath()));

        $fixer->fix($fileInfo, $tokens);

        $this->assertStringEqualsFile(
            __DIR__ . '/Fixtures/' . $expectedOutputFile,
            $tokens->generateCode()
        );
    }

    /**
     * @return array[]
     */
    public function provideFiles(): array
    {
        return [
            'Correct file should not be changed' => ['Correct.php.inc', 'Correct.php.inc'],
            'Wrong file should be fixed' => ['Wrong.php.inc', 'Fixed.php.inc'],
        ];
    }
}
