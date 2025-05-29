Compact methods for PHP
=======================

[![Build status on GitHub](https://github.com/xp-lang/php-compact-methods/workflows/Tests/badge.svg)](https://github.com/xp-lang/php-compact-methods/actions)
[![XP Framework Module](https://raw.githubusercontent.com/xp-framework/web/master/static/xp-framework-badge.png)](https://github.com/xp-framework/core)
[![BSD Licence](https://raw.githubusercontent.com/xp-framework/web/master/static/licence-bsd.png)](https://github.com/xp-framework/core/blob/master/LICENCE.md)
[![Requires PHP 7.4+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-7_4plus.svg)](http://php.net/)
[![Supports PHP 8.0+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-8_0plus.svg)](http://php.net/)
[![Latest Stable Version](https://poser.pugx.org/xp-lang/php-compact-methods/version.svg)](https://packagist.org/packages/xp-lang/php-compact-methods)

Plugin for the [XP Compiler](https://github.com/xp-framework/compiler/) which adds compact methods to the PHP language.

Example
-------
Compact methods use the `fn` keyword, much like [PHP 7.4 arrow functions](https://wiki.php.net/rfc/arrow_functions_v2). The RFC suggests this in its *Future Scope* section.

```php
class Person {
  private $name;

  public fn name(): string => $this->name;
}
```

Installation
------------
After installing the XP Compiler into your project, also include this plugin.

```bash
$ composer require xp-framework/compiler
# ...

$ composer require xp-lang/php-compact-methods
# ...
```

No further action is required.

See also
--------
* https://wiki.php.net/rfc/single-expression-functions
* https://wiki.php.net/rfc/short-functions
* https://wiki.php.net/rfc/arrow_functions_v2#allow_arrow_notation_for_real_functions
* https://github.com/xp-framework/rfc/issues/241