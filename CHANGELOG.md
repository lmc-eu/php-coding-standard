# Changelog

<!-- We follow Semantic Versioning (http://semver.org/) and Keep a Changelog principles (http://keepachangelog.com/) --> 

<!-- There is always Unreleased section on the top. Subsections (Added, Changed, Fixed, Removed) should be added as needed. -->

## Unreleased

## 1.3.0 - 2019-01-23
- Require EasyCodingStandard 5+.
- Add new fixers from PHP-CS-Fixer 2.14 and 2.13:
    - `CombineNestedDirnameFixer` - replace multiple nested calls of `dirname` by only one call with second `$level` parameter.
    - `FopenFlagOrderFixer` - order the flags in `fopen` calls, `b` and `t` must be last.
    - `FopenFlagsFixer` - the flags in `fopen` calls must contain `b` and must omit `t`.
    - `ImplodeCallFixer` - function `implode` must be called with 2 arguments in the documented order.
    - `PhpdocVarAnnotationCorrectOrderFixer` - `@var` and `@type` annotations must have type and name in the correct order
- Keep `@mixed` annotations preserved when explicitly declared.

## 1.2.0 - 2018-09-20
- Replace deprecated `Symplify\CodingStandard\Fixer\Naming\MagicMethodsNamingFixer` with `PhpCsFixer\Fixer\Casing\MagicMethodCasingFixer`.
- Add new fixers:
    - `NoSuperfluousPhpdocTagsFixer` to remove unnecessary `@return` and `@param` PHPDocs.
    - `PhpUnitTestCaseStaticMethodCallsFixer` to unify how assertion methods in PHPUnit tests are called.
    - `SetTypeToCastFixer` to ensure casting is used instead of `settype()` .

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
