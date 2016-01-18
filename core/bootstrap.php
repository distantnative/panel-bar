<?php

// Libraries
require_once(__DIR__ . '/lib/hooks.php');

// Helpers
require_once(__DIR__ . '/util/build.php');

// Elements
loadElements(__DIR__ . '/../elements');

// Plugins
loadElements(__DIR__ . '/../plugins');

// Modules
require_once(__DIR__ . '/modules/templates.php');
require_once(__DIR__ . '/modules/output.php');
require_once(__DIR__ . '/modules/assets.php');



function loadElements($dir) {
  foreach(array_diff(scandir($dir), array('.', '..')) as $file) {
    if(is_dir($file)) {
      require_once($dir . '/' . $file . '/' . $file . '.php');
    } elseif(substr($file, -4) === '.php') {
      require_once($dir . '/' . $file);
    }
  }
}
