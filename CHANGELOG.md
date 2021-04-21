# Changelog

<!-- We follow Semantic Versioning (http://semver.org/) and Keep a Changelog principles (http://keepachangelog.com/) --> 

<!-- There is always Unreleased section on the top. Subsections (Added, Changed, Fixed, Removed) should be added as needed. -->

## Unreleased
- `PhpUnitExpectationFixer` is used only on PHP 8.0+ See [symplify#3130](https://github.com/symplify/symplify/issues/3130).

## 3.0.0 - 2021-03-02
- **[BC break]** Change YAML config to PHP. See [UPGRADE-3.0.md](UPGRADE-3.0.md) for step-by-step upgrade howto.
- Replace `Symplify\CodingStandard\Sniffs\Naming\[AbstractClassNameSniff, ClassNameSuffixByParentSniff, InterfaceNameSniff and TraitNameSniff]` with equivalent versions backported to this repository.
- Drop PHP 7.2 support.
- Upgrade to easy-coding-standard 9.
- Add new fixers from PHP-CS-Fixer 2.17:
    - `ArrayPushFixer` - Converts simple usages of `array_push($x, $y);` to `$x[] = $y;`.
    - `SwitchContinueToBreakFixer` - Switch case must not be ended with `continue` but with `break`.
    - `LambdaNotUsedImportFixer` - Lambda must not import variables it doesn't use.
    - `NoUselessSprintfFixer` - There must be no `sprintf` calls with only the first argument.
    - `SingleSpaceAfterConstructFixer` - Ensures a single space after language constructs.
    - `CleanNamespaceFixer` - Namespace must not contain spacing, comments or PHPDoc.
    - `TernaryToElvisOperatorFixer` - Use the Elvis operator `?:` where possible.
    - `PhpdocOrderByValueFixer`  Order phpdoc tags by value (order by default contents of 'covers', 'group' and 'throws').
    - `HeredocIndentationFixer` - Heredoc/nowdoc content must be properly indented.
- Add new PHP_CodeSniffer sniffs:
    - `GitMergeConflictSniff` - Detects merge conflict artifacts left in files.

## 2.1.0 - 2020-11-25
- Add various dangerous function calls to list of forbidden functions.

## 2.0.4 - 2020-09-23
- Fix an improper fix of PSR-2 checks made in 2.0.3 to really make them being used again.

## 2.0.3 - 2020-05-04
- Fix PSR-2 checks to be used again (they were unintentionally not loaded since coding-standard version 2.0.0).
- Lock dependency of `symplify/coding-standard` to <7.2.20 to avoid deprecation errors.

## 2.0.2 - 2020-04-23
- Increase required version of symplify/easy-coding-standard to ^7.2.3.

## 2.0.1 - 2020-04-23
- Temporarily disable `ArrayDeclarationSniff.ValueNoNewline` because of [bug](https://github.com/squizlabs/PHP_CodeSniffer/issues/2937) in PHP_CodeSniffer 3.5.5.

## 2.0.0 - 2020-03-02
- BC: change the way the standard is imported to your `easy-coding-standard.yaml` (change `%vendor_dir%` placeholder directly to name of the vendor directory like `vendor`). See example in [README](https://github.com/lmc-eu/php-coding-standard#usage).
- Drop PHP 7.1 support.
- Require EasyCodingStandard 7+.
- `VisibilityRequiredFixer` now check visibility is declared also on class constants.
- Add `Symplify\ParamReturnAndVarTagMalformsFixer` - the `@param`, `@return` and `@var` annotations should keep standard format.
- Add new fixers from PHP-CS-Fixer 2.15 and 2.16:
    - `NativeFunctionTypeDeclarationCasingFixer` - native type hints for functions should use the correct case.
    - `SingleTraitInsertPerStatementFixer` - each trait `use` must be done as single statement.
    - `PhpUnitDedicateAssertInternalTypeFixer` - PHPUnit assertions like `assertIsArray()` should be used over `assertInternalType()` (PHPUnit 7.5+ required).
    - `PhpUnitMockShortWillReturnFixer` - Use of eg. `->will($this->returnValue(..))` must be replaced by its shorter equivalent such as `->willReturn(...)`.
- `NoSuperfluousPhpdocTagsFixer` now also removes superfluous `@inheritdoc` tags.

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
