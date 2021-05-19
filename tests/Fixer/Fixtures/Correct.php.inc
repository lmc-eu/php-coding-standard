<?php declare(strict_types=1);

namespace Lmc\CodingStandard\Fixer\Fixtures;

class Correct
{
    public function assembleQueryString(): void
    {
        $queryString1 = http_build_query(['foo' => 'bar'], null, '&');

        $queryString1WithMultipleWhitespaces = http_build_query(['foo' => 'bar'], null,   '&');

        $queryString1WithWhitespacesAndComments = http_build_query(['foo' => 'bar'], null, /* comment */  '&' /* x */);

        $queryString1WithComment = http_build_query(['foo' => 'bar'], /* Comment, with commas, */ null ,  '&');

        $queryString1WithObject = http_build_query((object) ['foo' => 'bar'], null, '&');

        $queryString2 = http_build_query(['foo' => 'bar', 'baz' => 'bat'], null, '&');

        $queryString3 = http_build_query(['foo' => 'bar'], null, '&amp;');

        $queryString4 = http_build_query(['foo' => 'bar'], null, ';');
    }
}
