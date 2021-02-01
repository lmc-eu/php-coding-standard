<?php

declare(strict_types=1);

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
use PhpCsFixer\Fixer\Alias\MbStrFunctionsFixer;
use PhpCsFixer\Fixer\Alias\NoAliasFunctionsFixer;
use PhpCsFixer\Fixer\Alias\RandomApiMigrationFixer;
use PhpCsFixer\Fixer\Alias\SetTypeToCastFixer;
use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoTrailingCommaInSinglelineArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\NormalizeIndexBraceFixer;
use PhpCsFixer\Fixer\ArrayNotation\TrailingCommaInMultilineArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\TrimArraySpacesFixer;
use PhpCsFixer\Fixer\ArrayNotation\WhitespaceAfterCommaInArrayFixer;
use PhpCsFixer\Fixer\Basic\BracesFixer;
use PhpCsFixer\Fixer\Basic\Psr4Fixer;
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
use PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer;
use PhpCsFixer\Fixer\FunctionNotation\CombineNestedDirnameFixer;
use PhpCsFixer\Fixer\FunctionNotation\FopenFlagOrderFixer;
use PhpCsFixer\Fixer\FunctionNotation\FopenFlagsFixer;
use PhpCsFixer\Fixer\FunctionNotation\FunctionTypehintSpaceFixer;
use PhpCsFixer\Fixer\FunctionNotation\ImplodeCallFixer;
use PhpCsFixer\Fixer\FunctionNotation\NoUnreachableDefaultArgumentValueFixer;
use PhpCsFixer\Fixer\FunctionNotation\ReturnTypeDeclarationFixer;
use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use PhpCsFixer\Fixer\Import\NoLeadingImportSlashFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\DeclareEqualNormalizeFixer;
use PhpCsFixer\Fixer\LanguageConstruct\IsNullFixer;
use PhpCsFixer\Fixer\ListNotation\ListSyntaxFixer;
use PhpCsFixer\Fixer\NamespaceNotation\NoLeadingNamespaceWhitespaceFixer;
use PhpCsFixer\Fixer\NamespaceNotation\SingleBlankLineBeforeNamespaceFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\NewWithBracesFixer;
use PhpCsFixer\Fixer\Operator\ObjectOperatorWithoutWhitespaceFixer;
use PhpCsFixer\Fixer\Operator\StandardizeNotEqualsFixer;
use PhpCsFixer\Fixer\Operator\TernaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\TernaryToNullCoalescingFixer;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\PhpTag\FullOpeningTagFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitConstructFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitDedicateAssertFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitDedicateAssertInternalTypeFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitExpectationFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitMockFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitMockShortWillReturnFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitNoExpectationAnnotationFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitOrderedCoversFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitSetUpTearDownVisibilityFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitTestCaseStaticMethodCallsFixer;
use PhpCsFixer\Fixer\Phpdoc\NoBlankLinesAfterPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\NoEmptyPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAddMissingParamAnnotationFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocIndentFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoAccessFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoEmptyReturnFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoPackageFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocOrderFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocReturnSelfReferenceFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocScalarFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSingleLineVarSpacingFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTrimFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTypesFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocVarAnnotationCorrectOrderFixer;
use PhpCsFixer\Fixer\ReturnNotation\NoUselessReturnFixer;
use PhpCsFixer\Fixer\Semicolon\NoEmptyStatementFixer;
use PhpCsFixer\Fixer\Semicolon\NoSinglelineWhitespaceBeforeSemicolonsFixer;
use PhpCsFixer\Fixer\Semicolon\SpaceAfterSemicolonFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Strict\StrictParamFixer;
use PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use PhpCsFixer\Fixer\Whitespace\CompactNullableTypehintFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use PhpCsFixer\Fixer\Whitespace\NoWhitespaceInBlankLineFixer;
use SlevomatCodingStandard\Sniffs\Exceptions\ReferenceThrowableOnlySniff;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\CodingStandard\Fixer\Commenting\ParamReturnAndVarTagMalformsFixer;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../symplify/easy-coding-standard/config/set/psr2.php', null, 'not_found');

    $containerConfigurator->import(__DIR__ . '/vendor/symplify/easy-coding-standard/config/set/psr2.php', null, 'not_found');

    $services = $containerConfigurator->services();

    $services->set(SpecifyArgSeparatorFixer::class);

    $services->set(AbstractClassNameSniff::class);

    $services->set(ClassNameSuffixByParentSniff::class);

    $services->set(InterfaceNameSniff::class);

    $services->set(TraitNameSniff::class);

    $services->set(DuplicateClassNameSniff::class);

    $services->set(EmptyStatementSniff::class);

    $services->set(ForLoopShouldBeWhileLoopSniff::class);

    $services->set(JumbledIncrementerSniff::class);

    $services->set(UnconditionalIfStatementSniff::class);

    $services->set(UnnecessaryFinalModifierSniff::class);

    $services->set(UselessOverridingMethodSniff::class);

    $services->set(DocCommentSniff::class);

    $services->set(LineLengthSniff::class)
        ->property('absoluteLineLimit', 0)
        ->property('lineLimit', 120);

    $services->set(OneClassPerFileSniff::class);

    $services->set(OneInterfacePerFileSniff::class);

    $services->set(OneTraitPerFileSniff::class);

    $services->set(SpaceAfterCastSniff::class);

    $services->set(ForbiddenFunctionsSniff::class)
        ->property('forbiddenFunctions', ['exec' => null, 'passthru' => null, 'proc_open' => null, 'shell_exec' => null, 'system' => null, 'pcntl_exec' => null, 'popen' => null, 'apache_setenv' => null, 'dl' => null, 'eval' => null, 'extract' => null, 'highlight_file' => null, 'pfsockopen' => null, 'posix_getpwuid' => null, 'posix_kill' => null, 'posix_mkfifo' => null, 'posix_mknod' => null, 'proc_nice' => null, 'putenv' => null, 'show_source' => null, 'socket_create_listen' => null, 'socket_listen' => null, 'include' => null, 'include_once' => null, 'require' => null, 'require_once' => null, 'dump' => null, 'echo' => null, 'phpinfo' => null, 'print_r' => null, 'printf' => null, 'var_export' => null, 'var_dump' => null]);

    $services->set(ArrayBracketSpacingSniff::class);

    $services->set(ArrayDeclarationSniff::class);

    $services->set(SelfMemberReferenceSniff::class);

    $services->set(DocCommentAlignmentSniff::class);

    $services->set(EmptyCatchCommentSniff::class);

    $services->set(IncrementDecrementUsageSniff::class);

    $services->set(MemberVarScopeSniff::class);

    $services->set(CastSpacingSniff::class);

    $services->set(LanguageConstructSpacingSniff::class);

    $services->set(LogicalOperatorSpacingSniff::class);

    $services->set(OperatorSpacingSniff::class)
        ->property('ignoreNewlines', true);

    $services->set(ScopeKeywordSpacingSniff::class);

    $services->set(SemicolonSpacingSniff::class);

    $services->set(MbStrFunctionsFixer::class);

    $services->set(NoAliasFunctionsFixer::class);

    $services->set(RandomApiMigrationFixer::class);

    $services->set(SetTypeToCastFixer::class);

    $services->set(ArraySyntaxFixer::class)
        ->call('configure', [['syntax' => 'short']]);

    $services->set(NormalizeIndexBraceFixer::class);

    $services->set(NoTrailingCommaInSinglelineArrayFixer::class);

    $services->set(TrailingCommaInMultilineArrayFixer::class);

    $services->set(TrimArraySpacesFixer::class);

    $services->set(WhitespaceAfterCommaInArrayFixer::class);

    $services->set(BracesFixer::class)
        ->call('configure', [['allow_single_line_closure' => true]]);

    $services->set(Psr4Fixer::class);

    $services->set(MagicMethodCasingFixer::class);

    $services->set(NativeFunctionCasingFixer::class);

    $services->set(NativeFunctionTypeDeclarationCasingFixer::class);

    $services->set(CastSpacesFixer::class);

    $services->set(LowercaseCastFixer::class);

    $services->set(ShortScalarCastFixer::class);

    $services->set(ClassAttributesSeparationFixer::class)
        ->call('configure', [['elements' => ['method']]]);

    $services->set(NoBlankLinesAfterClassOpeningFixer::class);

    $services->set(SelfAccessorFixer::class);

    $services->set(SingleTraitInsertPerStatementFixer::class);

    $services->set(VisibilityRequiredFixer::class)
        ->call('configure', [['elements' => ['const', 'method', 'property']]]);

    $services->set(NoEmptyCommentFixer::class);

    $services->set(NoUselessElseFixer::class);

    $services->set(YodaStyleFixer::class)
        ->call('configure', [['equal' => false, 'identical' => false, 'less_and_greater' => false]]);

    $services->set(CombineNestedDirnameFixer::class);

    $services->set(FopenFlagOrderFixer::class);

    $services->set(FopenFlagsFixer::class);

    $services->set(FunctionTypehintSpaceFixer::class);

    $services->set(ImplodeCallFixer::class);

    $services->set(NoUnreachableDefaultArgumentValueFixer::class);

    $services->set(ReturnTypeDeclarationFixer::class);

    $services->set(VoidReturnFixer::class);

    $services->set(NoLeadingImportSlashFixer::class);

    $services->set(NoUnusedImportsFixer::class);

    $services->set(OrderedImportsFixer::class);

    $services->set(DeclareEqualNormalizeFixer::class);

    $services->set(IsNullFixer::class)
        ->call('configure', [['use_yoda_style' => false]]);

    $services->set(ListSyntaxFixer::class)
        ->call('configure', [['syntax' => 'short']]);

    $services->set(NoLeadingNamespaceWhitespaceFixer::class);

    $services->set(SingleBlankLineBeforeNamespaceFixer::class);

    $services->set(BinaryOperatorSpacesFixer::class);

    $services->set(ConcatSpaceFixer::class)
        ->call('configure', [['spacing' => 'one']]);

    $services->set(NewWithBracesFixer::class);

    $services->set(ObjectOperatorWithoutWhitespaceFixer::class);

    $services->set(StandardizeNotEqualsFixer::class);

    $services->set(TernaryOperatorSpacesFixer::class);

    $services->set(TernaryToNullCoalescingFixer::class);

    $services->set(UnaryOperatorSpacesFixer::class);

    $services->set(NoBlankLinesAfterPhpdocFixer::class);

    $services->set(NoEmptyPhpdocFixer::class);

    $services->set(NoSuperfluousPhpdocTagsFixer::class)
        ->call('configure', [['allow_mixed' => true, 'allow_unused_params' => false, 'remove_inheritdoc' => true]]);

    $services->set(PhpdocAddMissingParamAnnotationFixer::class);

    $services->set(PhpdocIndentFixer::class);

    $services->set(PhpdocNoAccessFixer::class);

    $services->set(PhpdocNoEmptyReturnFixer::class);

    $services->set(PhpdocNoPackageFixer::class);

    $services->set(PhpdocOrderFixer::class);

    $services->set(PhpdocReturnSelfReferenceFixer::class);

    $services->set(PhpdocScalarFixer::class);

    $services->set(PhpdocSingleLineVarSpacingFixer::class);

    $services->set(PhpdocTrimFixer::class);

    $services->set(PhpdocTypesFixer::class);

    $services->set(PhpdocVarAnnotationCorrectOrderFixer::class);

    $services->set(FullOpeningTagFixer::class);

    $services->set(PhpUnitConstructFixer::class);

    $services->set(PhpUnitDedicateAssertFixer::class);

    $services->set(PhpUnitDedicateAssertInternalTypeFixer::class);

    $services->set(PhpUnitMockFixer::class);

    $services->set(PhpUnitMockShortWillReturnFixer::class);

    $services->set(PhpUnitNoExpectationAnnotationFixer::class);

    $services->set(PhpUnitExpectationFixer::class);

    $services->set(PhpUnitOrderedCoversFixer::class);

    $services->set(PhpUnitSetUpTearDownVisibilityFixer::class);

    $services->set(PhpUnitTestCaseStaticMethodCallsFixer::class)
        ->call('configure', [['call_type' => 'this']]);

    $services->set(NoUselessReturnFixer::class);

    $services->set(NoEmptyStatementFixer::class);

    $services->set(NoSinglelineWhitespaceBeforeSemicolonsFixer::class);

    $services->set(SpaceAfterSemicolonFixer::class);

    $services->set(DeclareStrictTypesFixer::class);

    $services->set(StrictParamFixer::class);

    $services->set(SingleQuoteFixer::class);

    $services->set(BlankLineBeforeStatementFixer::class)
        ->call('configure', [['statements' => ['return', 'try']]]);

    $services->set(CompactNullableTypehintFixer::class);

    $services->set(NoExtraBlankLinesFixer::class)
        ->call('configure', [['tokens' => ['break', 'continue', 'curly_brace_block', 'extra', 'parenthesis_brace_block', 'return', 'square_brace_block', 'throw', 'use', 'use_trait']]]);

    $services->set(NoWhitespaceInBlankLineFixer::class);

    $services->set(ReferenceThrowableOnlySniff::class);

    $services->set(ParamReturnAndVarTagMalformsFixer::class);

    $parameters = $containerConfigurator->parameters();

    $parameters->set('skip', ['PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\EmptyStatementSniff.DetectedCatch' => null, 'PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff.ContentAfterOpen' => null, 'PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff.ContentBeforeClose' => null, 'PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff.MissingShort' => null, 'PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff.NonParamGroup' => null, 'PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff.ParamGroup' => null, 'PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff.ParamNotFirst' => null, 'PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff.SpacingBeforeTags' => null, 'PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff.TagValueIndent' => null, 'PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff.CloseBraceNotAligned' => null, 'PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff.DoubleArrowNotAligned' => null, 'PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff.KeyNotAligned' => null, 'PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff.MultiLineNotAllowed' => null, 'PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff.SingleLineNotAllowed' => null, 'PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff.ValueNoNewline' => null, 'PHP_CodeSniffer\Standards\Squiz\Sniffs\Arrays\ArrayDeclarationSniff.ValueNotAligned' => null, 'PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting\DocCommentAlignmentSniff.SpaceAfterStar' => null]);
};
