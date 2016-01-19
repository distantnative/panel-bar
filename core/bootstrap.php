<?php

// Libraries
f::load(__DIR__ . '/lib/hooks.php');

// Modules
f::load(__DIR__ . '/modules/elements.php');
f::load(__DIR__ . '/modules/patterns.php');
f::load(__DIR__ . '/modules/templates.php');
f::load(__DIR__ . '/modules/output.php');
f::load(__DIR__ . '/modules/assets.php');

// Patterns
$dir = __DIR__ . '/patterns';
foreach(array_diff(scandir($dir), array('.', '..')) as $file) {
  f::load($dir . DS . $file);
}
