# Changelog

<!-- We follow Semantic Versioning (http://semver.org/) and Keep a Changelog principles (http://keepachangelog.com/) --> 

<!-- There is always Unreleased section on the top. Subsections (Added, Changed, Fixed, Removed) should be added as needed. -->

## Unreleased
- Add PHPUnit fixers:
    - `PhpUnitMockFixer`: Ensure dedicated helper methods `createMock()` and `createPartialMock()` are used where possible instead of `->getMock()`.
    - `PhpUnitNoExpectationAnnotationFixer`: Use `setExpectedException()` instead of `@expectedException` annotation.
    - `PhpUnitSetUpTearDownVisibilityFixer`: Visibility of `setUp()` and `tearDown()` method should be kept protected as defined in PHPUnit TestCase.
- Do not check for `EventSubscriber` class suffixes via `ClassNameSuffixByParentFixer`.

## 1.0.1 - 2018-04-09
- Replace deprecated `ExceptionNameFixer` with more generic `ClassNameSuffixByParentFixer`.

## 1.0.0 - 2018-04-03
- Initial version
