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
        // MbStrFunctionsFixer
        $bazLength = mb_strlen('baz');
        // LambdaNotUsedImportFixer
        $lambdaWithUnusedImport = function () { return 'foo'; };
        // NoUselessSprintfFixer
        $uselessSprintf = 'bar';
        // NoSpaceAroundDoubleColonFixer
        $className = DateTime::class;
        // ClassReferenceNameCasingFixer
        $date = new \DateTime();

        $aliasedClass = new Foo();

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

        // SingleLineCommentSpacingFixer
        // This comment should have space on the beginning
        /* So should this one, also with space on the end */

        // TernaryToElvisOperatorFixer
        return ($foo ?: 'not true');
    }
}
