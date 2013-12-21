Respect\Loader [![Build Status](https://secure.travis-ci.org/Respect/Loader.png)](http://travis-ci.org/Respect/Loader)
==============

A simple, minimalist class loader that implements the PSR-0 spec.

Configuration
-------------

Respect\Loader needs the include_path properly configured. Add your library to
the include_path directive in php.ini or set up in runtime like this:

```php
<?php
set_include_path('/path/to/library'. PATH_SEPARATOR . get_include_path());
```

See http://php.net/include_path for more info.

Usage
-----

Add this single line one single time to your project:

```php
<?php
spl_autoload_register(include 'Respect/Loader.php');
```
    
Installation
------------

Please use PEAR. More instructions on the [Respect PEAR channel](http://respect.li/pear)

Advanced Usage
--------------

If you don't like auto-registering, you can define a constant flag to Respect:

```php
<?php
const RESPECT_DO_NOT_RETURN_AUTOLOADER = true;
require_once('Respect\Loader.php');
spl_autoload_register(new Respect\Loader);
```

