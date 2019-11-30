Compact methods for PHP
=======================

[![Build Status on TravisCI](https://secure.travis-ci.org/xp-lang/php-compact-methods.svg)](http://travis-ci.org/xp-lang/php-compact-methods)
[![XP Framework Module](https://raw.githubusercontent.com/xp-framework/web/master/static/xp-framework-badge.png)](https://github.com/xp-framework/core)
[![BSD Licence](https://raw.githubusercontent.com/xp-framework/web/master/static/licence-bsd.png)](https://github.com/xp-framework/core/blob/master/LICENCE.md)
[![Requires PHP 7.0+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-7_0plus.png)](http://php.net/)
[![Latest Stable Version](https://poser.pugx.org/xp-lang/php-compact-methods/version.png)](https://packagist.org/packages/xp-lang/php-compact-methods)

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
* https://wiki.php.net/rfc/arrow_functions_v2#allow_arrow_notation_for_real_functions
* https://github.com/xp-framework/rfc/issues/241