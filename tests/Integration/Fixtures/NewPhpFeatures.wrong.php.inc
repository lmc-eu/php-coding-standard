<?php declare(strict_types=1);

namespace Lmc\CodingStandard\Integration\Fixtures;

class NewPhpFeatures
{
    private string $someString;

    public function __construct(string $someString)
    {
        $this->someString = $someString;
    }

    public function php80features(
        string | bool $foo, // UnionTypeHintFormatSniff
        int $bar // RequireTrailingCommaInDeclarationSniff
    ): string | bool {
        $value = mt_rand(
            0,
            $bar // RequireTrailingCommaInCallSniff
        );

        $dateOrNull = $this->mayReturnDateTimeOrNull();
        $timestamp = $dateOrNull !== null ? $dateOrNull->getTimestamp() : null; // RequireNullSafeObjectOperatorSniff

        return $foo;
    }

    public function mayReturnDateTimeOrNull(): ?\DateTime
    {
        return null;
    }
}
