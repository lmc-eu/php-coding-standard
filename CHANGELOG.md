# Changelog

<!-- We follow Semantic Versioning (http://semver.org/) and Keep a Changelog principles (http://keepachangelog.com/) --> 

<!-- There is always Unreleased section on the top. Subsections (Added, Changed, Fixed, Removed) should be added as needed. -->

## Unreleased

## 1.1.2 - 2018-07-19
- Change deprecated implementation of `Symplify\CodingStandard\Fixer\Naming\ClassNameSuffixByParentFixer` to `Symplify\CodingStandard\Sniffs\Naming\ClassNameSuffixByParentSniff`

## 1.1.1 - 2018-06-07
- Fix `Generic.Commenting.DocComment.SpacingBeforeTags` being reported on one-line phpDoc annotations (when PHP_Codesniffer 3.3.0+ is used).

## 1.1.0 - 2018-05-14
- Add `SpecifyArgSeparatorFixer` to make sure arg_separator is always defined when using `http_build_query()` function.
- Add PHPUnit fixers:
    - `PhpUnitMockFixer`: Ensure dedicated helper methods `createMock()` and `createPartialMock()` are used where possible instead of `->getMock()`.
    - `PhpUnitNoExpectationAnnotationFixer`: Use `setExpectedException()` instead of `@expectedException` annotation.
    - `PhpUnitSetUpTearDownVisibilityFixer`: Visibility of `setUp()` and `tearDown()` method should be kept protected as defined in PHPUnit TestCase.
- Do not check for `EventSubscriber` class suffixes via `ClassNameSuffixByParentFixer`.

## 1.0.1 - 2018-04-09
- Replace deprecated `ExceptionNameFixer` with more generic `ClassNameSuffixByParentFixer`.

## 1.0.0 - 2018-04-03
- Initial version
