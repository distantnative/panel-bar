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

$kirby->set('panelBar', 'files', dirname(__DIR__) . DS . 'elements' . DS . 'files');
$kirby->set('panelBar', 'images', dirname(__DIR__) . DS . 'elements' . DS . 'images');
$kirby->set('panelBar', 'add', dirname(__DIR__) . DS . 'elements' . DS . 'add');


//====================================
//   Modules
//====================================
f::load($dir . 'modules' . DS . 'assets.php');
f::load($dir . 'modules' . DS . 'html.php');
f::load($dir . 'modules' . DS . 'elements.php');
f::load($dir . 'modules' . DS . 'element.php');
f::load($dir . 'modules' . DS . 'pattern.php');


//====================================
//   Elements
//====================================
foreach(dir::read($dir . 'elements') as $file) {
  $kirby->set('panelBar', $file, $dir . DS . 'elements' . DS . $file);

}


//====================================
//   Patterns
//====================================
foreach(dir::read($dir . 'patterns') as $file) {
  f::load($dir . 'patterns' . DS . $file);
}
