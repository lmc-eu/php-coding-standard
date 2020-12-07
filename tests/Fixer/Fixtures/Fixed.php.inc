<?php declare(strict_types=1);

function http_build_query($should, $not, $change): void
{
    // this should not be affected
}

function assembleQueryString(): void
{
    $queryString1 = http_build_query(['foo' => 'bar'], null, '&');

    $queryString2 = http_build_query(['foo' => 'bar'], 333, '&');

    $queryString3 = http_build_query(['foo' => 'bar'], 333, '&');

    $queryString4 = http_build_query(['foo' => 'bar'], 333, '&', PHP_QUERY_RFC3986);

    $queryString5 = http_build_query(['foo' => 'bar'], null, '&', PHP_QUERY_RFC3986);

    $queryString6 = http_build_query(['foo' => 'bar', 'baz' => 'ban'], null, '&', PHP_QUERY_RFC3986);

    $queryString6 = http_build_query((object) ['foo' => 'bar', 'baz' => 'ban'], null, '&', PHP_QUERY_RFC3986);
}
