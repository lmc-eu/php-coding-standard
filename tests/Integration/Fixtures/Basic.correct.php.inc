<?php declare(strict_types=1);

class Basic
{
    public const FOO = 'foo'; // ClassAttributesSeparationFixer

    public function isEqual($a, $b) // VisibilityRequiredFixer
    {
        // TrimArraySpacesFixer
        $fooBar = ['a', 'b'];
        // MbStrFunctionsFixer
        $bazLength = mb_strlen('baz');
        // LambdaNotUsedImportFixer
        $lambdaWithUnusedImport = function () { return 'foo'; };
        // NoUselessSprintfFixer
        $uselessSprintf = 'bar';
        // SingleSpaceAfterConstructFixer
        if ($a == $b) {
            return true;
        }

        return false; // BlankLineBeforeStatementFixer
    }

    public function fooBar(mixed $foo): mixed
    {
        // PhpdocToCommentFixer
        /*
         * Phpdoc used instead of plain comment
         */
        if ($foo === 'bar') {
            // NoAliasFunctionsFixer
            $baz = implode(',', ['foo', 'bar']);
        }

        // TernaryToElvisOperatorFixer
        return ($foo ?: 'not true');
    }
}
