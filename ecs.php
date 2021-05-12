<?php declare(strict_types=1);

use Lmc\CodingStandard\Fixer\SpecifyArgSeparatorFixer;
use Lmc\CodingStandard\Sniffs\Naming\AbstractClassNameSniff;
use Lmc\CodingStandard\Sniffs\Naming\ClassNameSuffixByParentSniff;
use Lmc\CodingStandard\Sniffs\Naming\InterfaceNameSniff;
use Lmc\CodingStandard\Sniffs\Naming\TraitNameSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Classes\DuplicateClassNameSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\EmptyStatementSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\ForLoopShouldBeWhileLoopSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\JumbledIncrementerSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\UnconditionalIfStatementSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\UnnecessaryFinalModifierSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\UselessOverridingMethodSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\OneClassPerFileSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\OneInterfacePerFileSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\OneTraitPerFileSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting\SpaceAfterCastSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\ForbiddenFunctionsSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\VersionControl\GitMergeConflictSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayBracketSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Classes\SelfMemberReferenceSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\DocCommentAlignmentSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\EmptyCatchCommentSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Operators\IncrementDecrementUsageSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Scope\MemberVarScopeSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\CastSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\LanguageConstructSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\LogicalOperatorSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\OperatorSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\ScopeKeywordSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\SemicolonSpacingSniff;
use PhpCsFixer\Fixer\Alias\ArrayPushFixer;
use PhpCsFixer\Fixer\Alias\MbStrFunctionsFixer;
use PhpCsFixer\Fixer\Alias\NoAliasFunctionsFixer;
use PhpCsFixer\Fixer\Alias\RandomApiMigrationFixer;
use PhpCsFixer\Fixer\Alias\SetTypeToCastFixer;
use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\ArrayNotation\NormalizeIndexBraceFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoTrailingCommaInSinglelineArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\TrimArraySpacesFixer;
use PhpCsFixer\Fixer\ArrayNotation\WhitespaceAfterCommaInArrayFixer;
use PhpCsFixer\Fixer\Basic\BracesFixer;
use PhpCsFixer\Fixer\Basic\PsrAutoloadingFixer;
use PhpCsFixer\Fixer\Casing\MagicMethodCasingFixer;
use PhpCsFixer\Fixer\Casing\NativeFunctionCasingFixer;
use PhpCsFixer\Fixer\Casing\NativeFunctionTypeDeclarationCasingFixer;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\CastNotation\LowercaseCastFixer;
use PhpCsFixer\Fixer\CastNotation\ShortScalarCastFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ClassNotation\NoBlankLinesAfterClassOpeningFixer;
use PhpCsFixer\Fixer\ClassNotation\SelfAccessorFixer;
use PhpCsFixer\Fixer\ClassNotation\SingleTraitInsertPerStatementFixer;
use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\Comment\NoEmptyCommentFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUselessElseFixer;
use PhpCsFixer\Fixer\ControlStructure\SwitchContinueToBreakFixer;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer;
use PhpCsFixer\Fixer\FunctionNotation\CombineNestedDirnameFixer;
use PhpCsFixer\Fixer\FunctionNotation\FopenFlagOrderFixer;
use PhpCsFixer\Fixer\FunctionNotation\FopenFlagsFixer;
use PhpCsFixer\Fixer\FunctionNotation\FunctionTypehintSpaceFixer;
use PhpCsFixer\Fixer\FunctionNotation\ImplodeCallFixer;
use PhpCsFixer\Fixer\FunctionNotation\LambdaNotUsedImportFixer;
use PhpCsFixer\Fixer\FunctionNotation\NoUnreachableDefaultArgumentValueFixer;
use PhpCsFixer\Fixer\FunctionNotation\NoUselessSprintfFixer;
use PhpCsFixer\Fixer\FunctionNotation\ReturnTypeDeclarationFixer;
use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use PhpCsFixer\Fixer\Import\NoLeadingImportSlashFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\DeclareEqualNormalizeFixer;
use PhpCsFixer\Fixer\LanguageConstruct\IsNullFixer;
use PhpCsFixer\Fixer\LanguageConstruct\SingleSpaceAfterConstructFixer;
use PhpCsFixer\Fixer\ListNotation\ListSyntaxFixer;
use PhpCsFixer\Fixer\NamespaceNotation\CleanNamespaceFixer;
use PhpCsFixer\Fixer\NamespaceNotation\NoLeadingNamespaceWhitespaceFixer;
use PhpCsFixer\Fixer\NamespaceNotation\SingleBlankLineBeforeNamespaceFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\NewWithBracesFixer;
use PhpCsFixer\Fixer\Operator\ObjectOperatorWithoutWhitespaceFixer;
use PhpCsFixer\Fixer\Operator\StandardizeNotEqualsFixer;
use PhpCsFixer\Fixer\Operator\TernaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\TernaryToElvisOperatorFixer;
use PhpCsFixer\Fixer\Operator\TernaryToNullCoalescingFixer;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Phpdoc\NoBlankLinesAfterPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\NoEmptyPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAddMissingParamAnnotationFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocIndentFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoAccessFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoEmptyReturnFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoPackageFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocOrderByValueFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocOrderFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocReturnSelfReferenceFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocScalarFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSingleLineVarSpacingFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTrimFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTypesFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocVarAnnotationCorrectOrderFixer;
use PhpCsFixer\Fixer\PhpTag\FullOpeningTagFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitConstructFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitDedicateAssertFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitDedicateAssertInternalTypeFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitExpectationFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitMockFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitMockShortWillReturnFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitNoExpectationAnnotationFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitSetUpTearDownVisibilityFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitTestCaseStaticMethodCallsFixer;
use PhpCsFixer\Fixer\ReturnNotation\NoUselessReturnFixer;
use PhpCsFixer\Fixer\Semicolon\NoEmptyStatementFixer;
use PhpCsFixer\Fixer\Semicolon\NoSinglelineWhitespaceBeforeSemicolonsFixer;
use PhpCsFixer\Fixer\Semicolon\SpaceAfterSemicolonFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Strict\StrictParamFixer;
use PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use PhpCsFixer\Fixer\Whitespace\CompactNullableTypehintFixer;
use PhpCsFixer\Fixer\Whitespace\HeredocIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use PhpCsFixer\Fixer\Whitespace\NoWhitespaceInBlankLineFixer;
use SlevomatCodingStandard\Sniffs\Exceptions\ReferenceThrowableOnlySniff;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\CodingStandard\Fixer\Commenting\ParamReturnAndVarTagMalformsFixer;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $vendorDir = __DIR__ . '/vendor'; // When used directly (during development)
    if (!is_dir($vendorDir)) {
        $vendorDir = __DIR__ . '/../..'; // When installed as a dependency (in vendor dir)
    }

    $containerConfigurator->import($vendorDir . '/symplify/easy-coding-standard/config/set/php_cs_fixer/php-cs-fixer-psr2.php');
    $containerConfigurator->import($vendorDir . '/symplify/easy-coding-standard/config/set/php_codesniffer/php-codesniffer-psr2.php');

    $services = $containerConfigurator->services();
    (function () use ($services): void {
        // Function http_build_query() should always have specified `$arg_separator` parameter
        $services->set(SpecifyArgSeparatorFixer::class);
        // Abstract class should have prefix "Abstract"
        $services->set(AbstractClassNameSniff::class);
        // Classes should have suffix by theirs parent class/interface
        $services->set(ClassNameSuffixByParentSniff::class);
        // Interface should have suffix "Interface"
        $services->set(InterfaceNameSniff::class);
        // Trait should have suffix "Trait"
        $services->set(TraitNameSniff::class);
        // Class and Interface names should be unique in a project, they should never be duplicated
        $services->set(DuplicateClassNameSniff::class);
        // Control Structures must have at least one statement inside of the body (empty catch rules is skipped)
        $services->set(EmptyStatementSniff::class);
        // For loops that have only a second expression (the condition) should be converted to while loops
        $services->set(ForLoopShouldBeWhileLoopSniff::class);
        // Incrementers in nested loops should use different variable names
        $services->set(JumbledIncrementerSniff::class);
        // If statements that are always evaluated should not be used
        $services->set(UnconditionalIfStatementSniff::class);
        // Methods should not be declared final inside of classes that are declared final
        $services->set(UnnecessaryFinalModifierSniff::class);
        // Methods should not be defined that only call the parent method
        $services->set(UselessOverridingMethodSniff::class);
        // Doc comment formatting (but some of the rules are skipped)
        $services->set(DocCommentSniff::class);
        // Line length should not exceed 120 characters
        $services->set(LineLengthSniff::class)
            ->property('absoluteLineLimit', 0)
            ->property('lineLimit', 120);
        // There should only be one class defined in a file
        $services->set(OneClassPerFileSniff::class);
        // There should only be one interface defined in a file
        $services->set(OneInterfacePerFileSniff::class);
        // There should only be one trait defined in a file
        $services->set(OneTraitPerFileSniff::class);
        // Exactly one space is allowed after a cast
        $services->set(SpaceAfterCastSniff::class);
        // Some functions should not appear in the code
        $services->set(ForbiddenFunctionsSniff::class)
            ->property(
                'forbiddenFunctions',
                [
                    // Program execution functions, inspired by https://github.com/spaze/phpstan-disallowed-calls
                    'exec' => null,
                    'passthru' => null,
                    'proc_open' => null,
                    'shell_exec' => null,
                    'system' => null,
                    'pcntl_exec' => null,
                    'popen' => null,

                    // Dangerous function calls, inspired by https://github.com/spaze/phpstan-disallowed-calls
                    'apache_setenv' => null, // might overwrite existing variables
                    'dl' => null, // removed from most SAPIs, might load untrusted code
                    'eval' => null, // eval is evil, please write more code and do not use eval()
                    'extract' => null, // do not use extract() and especially not on untrusted data
                    'highlight_file' => null, // might reveal source code or config files
                    'pfsockopen' => null, // use fsockopen() to create non-persistent socket connections
                    'posix_getpwuid' => null, // might reveal system user information
                    'posix_kill' => null, // do not send signals to processes from the script
                    'posix_mkfifo' => null, // do not create named pipes in the script
                    'posix_mknod' => null, // do not create special files in the script
                    'proc_nice' => null, // changes the priority of the current process
                    'putenv' => null, // might overwrite existing variables
                    'show_source' => null, // might reveal source code or config files (alias of highlight_file())
                    'socket_create_listen' => null, // do not accept new socket connections in the PHP script
                    'socket_listen' => null, // do not accept new socket connections in the PHP script

                    // PHP include/require functions, use autoloading instead
                    'include' => null,
                    'include_once' => null,
                    'require' => null,
                    'require_once' => null,

                    // Probably forgotten debug calls, use logger instead
                    'dump' => null,
                    'echo' => null,
                    'phpinfo' => null,
                    'print_r' => null,
                    'printf' => null,
                    'var_export' => null,
                    'var_dump' => null,
                ]
            );
        // When referencing arrays you should not put whitespace around the opening bracket or before the closing bracket
        $services->set(ArrayBracketSpacingSniff::class);
        // Various array declaration rules (but some of the rules are skipped)
        $services->set(ArrayDeclarationSniff::class);
        // The self keyword should be used instead of the current class name
        $services->set(SelfMemberReferenceSniff::class);
        // The asterisks in a doc comment should align, and there should be one space between the asterisk and tags
        $services->set(DocCommentAlignmentSniff::class);
        // Empty catch statements must have comment explaining why the exception is not handled
        $services->set(EmptyCatchCommentSniff::class);
        // Tests that the ++ operators are used when possible and not used when it makes the code confusing
        $services->set(IncrementDecrementUsageSniff::class);
        // Verifies that class members have scope modifiers
        $services->set(MemberVarScopeSniff::class);
        // Detects merge conflict artifacts left in files
        $services->set(GitMergeConflictSniff::class);
        // Casts should not have whitespace inside the parentheses
        $services->set(CastSpacingSniff::class);
        // The php constructs like echo, return, include, etc. should have one space after them
        $services->set(LanguageConstructSpacingSniff::class);
        // Verifies that operators have valid spacing surrounding them
        $services->set(LogicalOperatorSpacingSniff::class);
        // Proper operator spacing
        $services->set(OperatorSpacingSniff::class)
            ->property('ignoreNewlines', true);
        // The php keywords static, public, private, and protected should have one space after them
        $services->set(ScopeKeywordSpacingSniff::class);
        // Semicolons should not have spaces before them
        $services->set(SemicolonSpacingSniff::class);
        // Converts simple usages of `array_push($x, $y);` to `$x[] = $y;`.
        $services->set(ArrayPushFixer::class);
        // Replace non multibyte-safe functions with corresponding mb function
        $services->set(MbStrFunctionsFixer::class);
        // Master functions shall be used instead of aliases
        $services->set(NoAliasFunctionsFixer::class);
        // Replaces `rand`, `srand`, `getrandmax` functions calls with their `mt_*` analogs
        $services->set(RandomApiMigrationFixer::class);
        // Cast shall be used, not `settype()`
        $services->set(SetTypeToCastFixer::class);
        // PHP arrays should be declared using the configured syntax
        $services->set(ArraySyntaxFixer::class)
            ->call('configure', [['syntax' => 'short']]);
        // Array index should always be written by using square braces
        $services->set(NormalizeIndexBraceFixer::class);
        // PHP single-line arrays should not have trailing comma
        $services->set(NoTrailingCommaInSinglelineArrayFixer::class);
        // Multi-line arrays, arguments list and parameters list must have a trailing comma
        $services->set(TrailingCommaInMultilineFixer::class);
        // Arrays should be formatted like function/method arguments
        $services->set(TrimArraySpacesFixer::class);
        // In array declaration, there MUST be a whitespace after each comma
        $services->set(WhitespaceAfterCommaInArrayFixer::class);
        // The body of each structure MUST be enclosed by braces. Braces should be properly placed
        $services->set(BracesFixer::class)
            ->call(
                'configure',
                [['allow_single_line_closure' => true, 'allow_single_line_anonymous_class_with_empty_body' => true]]
            );
        // Classes must be in a path that matches their namespace
        $services->set(PsrAutoloadingFixer::class);

        // Magic method definitions and calls must be using the correct casing
        $services->set(MagicMethodCasingFixer::class);
        // Function defined by PHP should be called using the correct casing
        $services->set(NativeFunctionCasingFixer::class);
        // Native type hints for functions should use the correct case
        $services->set(NativeFunctionTypeDeclarationCasingFixer::class);
        // A single space or none should be between cast and variable
        $services->set(CastSpacesFixer::class);
        // Cast should be written in lower case
        $services->set(LowercaseCastFixer::class);
        // Cast like `(boolean)` and `(integer)` should be written as `(bool)`, `(int)` etc.
        $services->set(ShortScalarCastFixer::class);
        // Class, trait and interface elements must be separated with one or none blank line
        $services->set(ClassAttributesSeparationFixer::class)
            ->call('configure', [['elements' => ['method' => 'one']]]);
        // There should be no empty lines after class opening brace
        $services->set(NoBlankLinesAfterClassOpeningFixer::class);
        // Inside class or interface element `self` should be preferred to the class name itself
        $services->set(SelfAccessorFixer::class);
        // Each trait `use` must be done as single statement
        $services->set(SingleTraitInsertPerStatementFixer::class);
        // Visibility MUST be declared on all properties, methods and class constants
        $services->set(VisibilityRequiredFixer::class)
            ->call('configure', [['elements' => ['const', 'method', 'property']]]);
        // There should not be any empty comments
        $services->set(NoEmptyCommentFixer::class);
        // There should not be useless `else` cases
        $services->set(NoUselessElseFixer::class);
        // Switch case must not be ended with `continue` but with `break`.
        $services->set(SwitchContinueToBreakFixer::class);
        // Conditions must be written in non-Yoda style
        $services->set(YodaStyleFixer::class)
            ->call('configure', [['equal' => false, 'identical' => false, 'less_and_greater' => false]]);
        // Replace multiple nested calls of `dirname` by only one call with second `$level` parameter.
        $services->set(CombineNestedDirnameFixer::class);
        // Order the flags in `fopen` calls, `b` and `t` must be last.
        $services->set(FopenFlagOrderFixer::class);
        // The flags in `fopen` calls must contain `b` and must omit `t`.
        $services->set(FopenFlagsFixer::class);
        // Add missing space between function's argument and its typehint.
        $services->set(FunctionTypehintSpaceFixer::class);
        // Function `implode` must be called with 2 arguments in the documented order.
        $services->set(ImplodeCallFixer::class);
        // Lambda must not import variables it doesn't use.
        $services->set(LambdaNotUsedImportFixer::class);
        // In function arguments there must not be arguments with default values before non-default ones.
        $services->set(NoUnreachableDefaultArgumentValueFixer::class);
        // There must be no `sprintf` calls with only the first argument.
        $services->set(NoUselessSprintfFixer::class);

        $services->set(ReturnTypeDeclarationFixer::class);

        $services->set(VoidReturnFixer::class);

        $services->set(NoLeadingImportSlashFixer::class);

        $services->set(NoUnusedImportsFixer::class);

        $services->set(OrderedImportsFixer::class);

        $services->set(DeclareEqualNormalizeFixer::class);
        // Replaces `is_null($var)` expression with `null === $var`
        $services->set(IsNullFixer::class);
        // Ensures a single space after language constructs.
        $services->set(SingleSpaceAfterConstructFixer::class);

        $services->set(ListSyntaxFixer::class)
            ->call('configure', [['syntax' => 'short']]);
        // Namespace must not contain spacing, comments or PHPDoc.
        $services->set(CleanNamespaceFixer::class);
        // The namespace declaration line shouldn\'t contain leading whitespace.
        $services->set(NoLeadingNamespaceWhitespaceFixer::class);
        // There should be exactly one blank line before a namespace declaration.
        $services->set(SingleBlankLineBeforeNamespaceFixer::class);

        $services->set(BinaryOperatorSpacesFixer::class);

        $services->set(ConcatSpaceFixer::class)
            ->call('configure', [['spacing' => 'one']]);

        $services->set(NewWithBracesFixer::class);

        $services->set(ObjectOperatorWithoutWhitespaceFixer::class);

        $services->set(StandardizeNotEqualsFixer::class);
        // Standardize spaces around ternary operator.
        $services->set(TernaryOperatorSpacesFixer::class);
        // Use the Elvis operator `?:` where possible.
        $services->set(TernaryToElvisOperatorFixer::class);
        // Use `null` coalescing operator `??` where possible.
        $services->set(TernaryToNullCoalescingFixer::class);

        $services->set(UnaryOperatorSpacesFixer::class);

        $services->set(NoBlankLinesAfterPhpdocFixer::class);

        $services->set(NoEmptyPhpdocFixer::class);
        // Removes `@param` and `@return` tags that don't provide any useful information
        $services->set(NoSuperfluousPhpdocTagsFixer::class)
            ->call(
                'configure',
                [
                    [
                        'allow_mixed' => true, // allow `@mixed` annotations to be preserved
                        'allow_unused_params' => false, // whether param annotation without actual signature is allowed
                        'remove_inheritdoc' => true, // remove @inheritDoc tags
                    ],
                ]
            );
        // PHPDoc should contain `@param` for all params.
        $services->set(PhpdocAddMissingParamAnnotationFixer::class);
        // Docblocks should have the same indentation as the documented subject.
        $services->set(PhpdocIndentFixer::class);
        // `@access` annotations should be omitted from PHPDoc.
        $services->set(PhpdocNoAccessFixer::class);
        // `@return void` and `@return null` annotations should be omitted from PHPDoc.
        $services->set(PhpdocNoEmptyReturnFixer::class);
        // `@package` and `@subpackage` annotations should be omitted from PHPDoc.
        $services->set(PhpdocNoPackageFixer::class);
        // Order phpdoc tags by value.
        $services->set(PhpdocOrderByValueFixer::class)
            ->call(
                'configure',
                [['annotations' => ['covers', 'group', 'throws']]]
            );
        // Annotations in PHPDoc should be ordered.
        $services->set(PhpdocOrderFixer::class);
        // The type of `@return` annotations of methods returning a reference to itself must the configured one.
        $services->set(PhpdocReturnSelfReferenceFixer::class);
        // Scalar types should always be written in the same form.
        $services->set(PhpdocScalarFixer::class);
        // Single line `@var` PHPDoc should have proper spacing.
        $services->set(PhpdocSingleLineVarSpacingFixer::class);
        // PHPDoc should start and end with content
        $services->set(PhpdocTrimFixer::class);
        // The correct case must be used for standard PHP types in PHPDoc.
        $services->set(PhpdocTypesFixer::class);
        // `@var` and `@type` annotations must have type and name in the correct order
        $services->set(PhpdocVarAnnotationCorrectOrderFixer::class);
        // PHP code must use the long `<?php` tags or short-echo `<?=` tags and not other tag variations
        $services->set(FullOpeningTagFixer::class);
        // PHPUnit assertion method calls like ->assertSame(true, $foo) should be written with dedicated method like ->assertTrue($foo)
        $services->set(PhpUnitConstructFixer::class);
        // PHPUnit assertions like assertInternalType, assertFileExists, should be used over assertTrue
        $services->set(PhpUnitDedicateAssertFixer::class);
        // PHPUnit assertions like assertIsArray should be used over assertInternalType
        $services->set(PhpUnitDedicateAssertInternalTypeFixer::class);
        // Use dedicated helper methods createMock() and createPartialMock() where possible
        $services->set(PhpUnitMockFixer::class);
        // Use of eg. ->will($this->returnValue(..)) must be replaced by its shorter equivalent such as ->willReturn(...)
        $services->set(PhpUnitMockShortWillReturnFixer::class);
        // Use expectedException*() methods instead of @expectedException* annotation (both following fixers must be applied to do so)
        $services->set(PhpUnitNoExpectationAnnotationFixer::class);

        // Following check fails on PHP <8.0. See https://github.com/symplify/symplify/issues/3130
        if (PHP_VERSION_ID >= 80000) {
            // Usages of ->setExpectedException* methods MUST be replaced by ->expectException* methods
            $services->set(PhpUnitExpectationFixer::class);
        }

        // Visibility of setUp() and tearDown() method should be kept protected
        $services->set(PhpUnitSetUpTearDownVisibilityFixer::class);
        // Calls to `PHPUnit\Framework\TestCase` static methods must all be of the same type (`$this->...`)
        $services->set(PhpUnitTestCaseStaticMethodCallsFixer::class)
            ->call('configure', [['call_type' => 'this']]);
        // There should not be an empty `return` statement at the end of a function
        $services->set(NoUselessReturnFixer::class);
        // Remove useless (semicolon) statements
        $services->set(NoEmptyStatementFixer::class);
        // Single-line whitespace before closing semicolon are prohibited
        $services->set(NoSinglelineWhitespaceBeforeSemicolonsFixer::class);
        // Fix whitespace after a semicolon
        $services->set(SpaceAfterSemicolonFixer::class);
        // Force strict types declaration in all files
        $services->set(DeclareStrictTypesFixer::class);
        // Functions should be used with `$strict` param set to `true`
        $services->set(StrictParamFixer::class);
        // Convert double quotes to single quotes for simple strings
        $services->set(SingleQuoteFixer::class);
        // An empty line feed must precede any configured statement
        $services->set(BlankLineBeforeStatementFixer::class)
            ->call('configure', [['statements' => ['return', 'try']]]);
        // Remove extra spaces in a nullable typehint
        $services->set(CompactNullableTypehintFixer::class);
        // Heredoc/nowdoc content must be properly indented.
        $services->set(HeredocIndentationFixer::class);
        // Removes extra blank lines and/or blank lines following configuration
        $services->set(NoExtraBlankLinesFixer::class)
            ->call(
                'configure',
                [['tokens' => ['break', 'continue', 'curly_brace_block', 'extra', 'parenthesis_brace_block', 'return', 'square_brace_block', 'throw', 'use', 'use_trait']]]
            );
        // Remove trailing whitespace at the end of blank lines
        $services->set(NoWhitespaceInBlankLineFixer::class);
        // Use \Throwable instead of \Exception
        $services->set(ReferenceThrowableOnlySniff::class);
        // The @param, @return, @var and inline @var annotations should keep standard format
        $services->set(ParamReturnAndVarTagMalformsFixer::class);
    })();

    $parameters = $containerConfigurator->parameters();
    (function () use ($parameters): void {
        $parameters->set(
            Option::SKIP,
            [
                // We allow empty catch statements (but they must have comment - see EmptyCatchCommentSniff)
                'PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\EmptyStatementSniff.DetectedCatch' => null,

                // Skip unwanted rules from DocCommentSniff
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff.ContentAfterOpen' => null,
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff.ContentBeforeClose' => null,
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff.MissingShort' => null,
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff.NonParamGroup' => null,
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff.ParamGroup' => null,
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff.ParamNotFirst' => null,
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff.SpacingBeforeTags' => null,
                'PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff.TagValueIndent' => null,

                // Skip unwanted rules from ArrayDeclarationSniff
                'PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff.CloseBraceNotAligned' => null,
                'PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff.DoubleArrowNotAligned' => null,
                'PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff.KeyNotAligned' => null,
                'PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff.MultiLineNotAllowed' => null,
                'PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff.SingleLineNotAllowed' => null,
                'PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff.ValueNoNewline' => null,
                'PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff.ValueNotAligned' => null,

                // There could be more than one space after star (eg. in Doctrine annotations)
                'PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\DocCommentAlignmentSniff.SpaceAfterStar' => null,

                // Allow single line closures
                'PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\ScopeClosingBraceSniff.ContentBefore' => null,
            ]
        );
    })();
};
