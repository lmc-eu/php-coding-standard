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
        // TernaryToElvisOperatorFixer
        return ($foo ?: 'not true');
    }
}
