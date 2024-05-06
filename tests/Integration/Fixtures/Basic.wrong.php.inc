<?php

use Bar\Foo as Foo; // NoUnneededImportAliasFixer

class Basic
{
    const FOO = 'foo'; // ClassAttributesSeparationFixer
    function isEqual($a, ? string $b): ? bool // VisibilityRequiredFixer, CompactNullableTypeDeclarationFixer
    {
        // TrimArraySpacesFixer
        $fooBar = [ 'a', 'b'];
        // NoTrailingCommaInSinglelineFixer
        mb_strlen('foobar', );
        // MbStrFunctionsFixer
        $bazLength = strlen('baz');
        // LambdaNotUsedImportFixer
        $lambdaWithUnusedImport = function () use ($fooBar) { return 'foo'; };
        // NoUselessSprintfFixer
        $uselessSprintf = sprintf('bar');
        // NoSpaceAroundDoubleColonFixer
        $className = DateTime :: class;
        // ClassReferenceNameCasingFixer
        $date = new \datetime();

        $aliasedClass = new Foo();

        // SingleSpaceAfterConstructFixer
        if ($a == $b) { return  true; }
        return false; // BlankLineBeforeStatementFixer
    }

    public const MY_PUBLIC_CONST = 333; // OrderedClassElementsFixer

    public function fooBar ( mixed    $foo ): mixed // FunctionDeclarationFixer
    {
        $value = 5;
        // FunctionDeclarationFixer
        $function = function($foo)use($value) {
            return $foo + $value;
        };
        // FunctionDeclarationFixer
        $fn = fn ($foo) => $foo + $value;

        // PhpdocToCommentFixer
        /**
         * Phpdoc used instead of plain comment
         */
        if ($foo === 'bar') {
            // NoAliasFunctionsFixer
            $baz = join(',', ['foo', 'bar']);
        }

        // SingleLineCommentSpacingFixer
        //This comment should have space on the beginning
        /*So should this one, also with space on the end*/

        // TernaryToElvisOperatorFixer
        return ($foo ? $foo : 'not true');
    }

    protected int $myProperty = 666; // OrderedClassElementsFixer

    use SomeUsefulTrait; // OrderedClassElementsFixer

    public function arrayDeclarations(): void
    {
        $empty = array();

        $singleLineArray = ['foo', 'bar', 'baz',];
        $singleLineArray2 = [1,2,3];

        $multiLineAssociative1 = [
            'foo' => 'bar', 'baz' => 'bat',
        ];

        $multiLineAssociative2 = [
            'foo'=>'bar',
                'baz'=>'bat',
        'bak'=>'baz'
        ];

        $multiLineAssociative3 = [
            'firstKey'        => 'bar',
            'thisIsSecondKey' => 'bat',
            'third'           => 'bat',
        ];
    }

    /**
     * Very well documented method.
     * It tests PhpdocAlignFixer, NoSuperfluousPhpdocTagsFixer and possibly other Phpdoc rules.
     * @param   string      $first
     * @throws  \Exception
     * @param   int|float   $second Second parameter does have a comment, unlike the first one.
     * @param   string|null $third Third parameter is optional and has a default value.
     * @return  mixed There is also information about return type.
     */
    public function veryWellDocumented(string $first, int|float $second, ?string $third = '3rd'): mixed
    {
        return $first . $third;
    }
}
