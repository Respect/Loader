<?php
/**
 * Bootstrap files for tests.
 */

date_default_timezone_set('UTC');
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('ROOT_PATH', realpath(__DIR__.DS.'..'));
define('FIXTURE_PATH', ROOT_PATH.DS.'tests'.DS.'fixtures');

// Including fixture paths (of classes) to PHP's include_path
$includePath = explode(PS, get_include_path());
$includePath[] = FIXTURE_PATH;
set_include_path(implode(PS, $includePath));
