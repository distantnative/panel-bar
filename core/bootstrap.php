<?php

namespace Kirby\panelBar;

use Dir;
use F;

$dir = __DIR__ . DS;

//====================================
//   Core
//====================================
f::load($dir . 'core.php');
f::load($dir . 'registry.php');


//====================================
//   Modules
//====================================
f::load($dir . 'modules' . DS . 'assets.php');
f::load($dir . 'modules' . DS . 'html.php');
f::load($dir . 'modules' . DS . 'elements.php');
f::load($dir . 'modules' . DS . 'element.php');
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
$dir = dirname(__DIR__) . DS;

foreach(dir::read($dir . 'elements') as $file) {
  $kirby->set('panelBar', $file, $dir . 'elements' . DS . $file);
}
