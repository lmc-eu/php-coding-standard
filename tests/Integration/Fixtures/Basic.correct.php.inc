<?php declare(strict_types=1);

use Bar\Foo; // NoUnneededImportAliasFixer

class Basic
{
    use SomeUsefulTrait; // OrderedClassElementsFixer
    public const FOO = 'foo'; // ClassAttributesSeparationFixer

    public const MY_PUBLIC_CONST = 333; // OrderedClassElementsFixer

    protected int $myProperty = 666; // OrderedClassElementsFixer

    public function isEqual($a, ?string $b): ?bool // VisibilityRequiredFixer, CompactNullableTypeDeclarationFixer
    {
        // TrimArraySpacesFixer
        $fooBar = ['a', 'b'];
        // NoTrailingCommaInSinglelineFixer
        mb_strlen('foobar');
        // MbStrFunctionsFixer
        $bazLength = mb_strlen('baz');
        // LambdaNotUsedImportFixer
        $lambdaWithUnusedImport = function () { return 'foo'; };
        // NoUselessSprintfFixer
        $uselessSprintf = 'bar';
        // StrictParamFixer
        $useStrictParam = in_array(1337, $fooBar, true);
        // NoSpaceAroundDoubleColonFixer
        $className = DateTime::class;
        // ClassReferenceNameCasingFixer
        $date = new \DateTime();

        $aliasedClass = new Foo();

        // SingleSpaceAfterConstructFixer, StrictComparisonFixer
        if ($a === $b || $bazLength !== 3) {
            return true;
        }

        return false; // BlankLineBeforeStatementFixer
    }

    public function fooBar(mixed $foo): mixed // FunctionDeclarationFixer
    {
        $value = 5;
        // FunctionDeclarationFixer
        $function = function ($foo) use ($value) {
            return $foo + $value;
        };
        // FunctionDeclarationFixer
        $fn = fn($foo) => $foo + $value;

        // PhpdocToCommentFixer
        /*
         * Phpdoc used instead of plain comment
         */
        if ($foo === 'bar') {
            // NoAliasFunctionsFixer
            $baz = implode(',', ['foo', 'bar']);
        }

        // SingleLineCommentSpacingFixer
        // This comment should have space on the beginning
        /* So should this one, also with space on the end */

        // TernaryToElvisOperatorFixer
        return ($foo ?: 'not true');
    }

    public function arrayDeclarations(): void
    {
        $empty = [];

        $singleLineArray = ['foo', 'bar', 'baz'];
        $singleLineArray2 = [1, 2, 3];

        $multiLineAssociative1 = [
            'foo' => 'bar',
            'baz' => 'bat',
        ];

        $multiLineAssociative2 = [
            'foo' => 'bar',
            'baz' => 'bat',
            'bak' => 'baz',
        ];

        $multiLineAssociative3 = [
            'firstKey' => 'bar',
            'thisIsSecondKey' => 'bat',
            'third' => 'bat',
        ];
    }

    /**
     * Very well documented method.
     * It tests PhpdocAlignFixer, NoSuperfluousPhpdocTagsFixer and possibly other Phpdoc rules.
     * @param int|float $second Second parameter does have a comment, unlike the first one.
     * @param string|null $third Third parameter is optional and has a default value.
     * @return mixed There is also information about return type.
     * @throws \Exception
     */
    public function veryWellDocumented(string $first, int|float $second, ?string $third = '3rd'): mixed
    {
        return $first . $third;
    }

    public function emptyFunction1(): void {} // SingleLineEmptyBodyFixer

    public function emptyFunction2(
        $arg,
    ): void {} // SingleLineEmptyBodyFixer
}
