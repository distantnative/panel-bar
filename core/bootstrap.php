<?php

// Libraries
require_once(__DIR__ . '/lib/hooks.php');

// Helpers
require_once(__DIR__ . '/util/tools.php');
require_once(__DIR__ . '/util/build.php');

// Elements
$dir = __DIR__ . '/../elements';
foreach(array_diff(scandir($dir), array('.', '..')) as $file) {
  if(substr($file, -4) === '.php') {
    require_once($dir . '/' . $file);
  }
}

// Plugins
$dir = __DIR__ . '/../plugins';
foreach(array_diff(scandir($dir), array('.', '..')) as $file) {
  if(is_dir($file)) {
    require_once($dir . '/' $file . '/' . $file . '.php');
  } elseif(substr($file, -4) === '.php') {
    require_once($dir . '/' . $file);
  }
}


// Modules
require_once(__DIR__ . '/modules/output.php');
require_once(__DIR__ . '/modules/assets.php');
