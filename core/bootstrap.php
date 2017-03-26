<?php

namespace Kirby\panelBar;

use Dir;
use F;

$dir  = __DIR__ . DS;
$root = dirname(__DIR__) . DS;

//====================================
//   Lib
//====================================
f::load($dir . 'lib' . DS . 'registry.php');
f::load($dir . 'lib' . DS . 'route.php');
f::load($dir . 'lib' . DS . 'helpers.php');

//====================================
//   Core
//====================================
f::load($dir . 'core.php');
f::load($dir . 'routes.php');

//====================================
//   Modules
//====================================
f::load($dir . 'modules' . DS . 'assets.php');
f::load($dir . 'modules' . DS . 'html.php');
f::load($dir . 'modules' . DS . 'elements.php');
f::load($dir . 'modules' . DS . 'element.php');
f::load($dir . 'modules' . DS . 'components.php');
f::load($dir . 'modules' . DS . 'pattern.php');

//====================================
//   Patterns
//====================================
foreach(dir::read($dir . 'patterns') as $file) {
  f::load($dir . 'patterns' . DS . $file);
}

//====================================
//   Elements
//====================================
foreach(dir::read(dirname(__DIR__) . DS . 'elements') as $file) {
  $kirby->set('panelBar', $file, $root . 'elements' . DS . $file);
}
