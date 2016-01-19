<?php

// Libraries
require_once(__DIR__ . '/lib/hooks.php');

// Modules
require_once(__DIR__ . '/modules/element.php');
require_once(__DIR__ . '/modules/patterns.php');
require_once(__DIR__ . '/modules/templates.php');
require_once(__DIR__ . '/modules/output.php');
require_once(__DIR__ . '/modules/assets.php');

// Patterns
$dir = __DIR__ . '/patterns';
foreach(array_diff(scandir($dir), array('.', '..')) as $file) {
  require_once($dir . DS . $file);
}
