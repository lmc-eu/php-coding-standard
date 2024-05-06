<?php

use Bar\Foo as Foo; // NoUnneededImportAliasFixer

class Basic
{
    const FOO = 'foo'; // ClassAttributesSeparationFixer
    function isEqual($a, ? string $b): ? bool // VisibilityRequiredFixer, CompactNullableTypeDeclarationFixer
    {
        // TrimArraySpacesFixer
        $fooBar = [ 'a', 'b'];
        // MbStrFunctionsFixer
        $bazLength = strlen('baz');
        // LambdaNotUsedImportFixer
        $lambdaWithUnusedImport = function () use ($fooBar) { return 'foo'; };
        // NoUselessSprintfFixer
        $uselessSprintf = sprintf('bar');
        // StrictParamFixer
        $useStrictParam = in_array(1337, $fooBar);
        // NoSpaceAroundDoubleColonFixer
        $className = DateTime :: class;
        // ClassReferenceNameCasingFixer
        $date = new \datetime();

        $aliasedClass = new Foo();

        // SingleSpaceAfterConstructFixer, StrictComparisonFixer
        if ($a == $b || $bazLength != 3) { return  true; }
        return false; // BlankLineBeforeStatementFixer
    }

    public function fooBar(mixed $foo): mixed
    {
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
}
