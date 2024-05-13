<?php declare(strict_types=1);

namespace Lmc\CodingStandard\Integration\Fixtures;

class PhpDoc
{
    // PhpdocToPropertyTypeFixer, PropertyTypeHintSniff
    /** @var int */
    private $integerValue = 3;
    private $undefinedTypeValue = 3;
    /** @var mixed */
    private $undeclaredMixedType;
    /** @var \DateTimeImmutable */
    private $nonScalarType;

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
