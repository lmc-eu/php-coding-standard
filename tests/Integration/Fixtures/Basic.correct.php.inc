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
        // SingleSpaceAfterConstructFixer, StrictComparisonFixer
        if ($a === $b || $bazLength !== 3) {
            return true;
        }

        return false; // BlankLineBeforeStatementFixer
    }

    public function fooBar(mixed $foo): mixed
    {
        // TernaryToElvisOperatorFixer
        return ($foo ?: 'not true');
    }
}
