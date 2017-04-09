<?php

namespace Kirby\panelBar;

use Dir;
use F;

function dir($folder = '', $root = false) {
  return ($root ? dirname(__DIR__) : __DIR__) . DS . $folder;
}

//====================================
//   Lib
//====================================
f::load(dir('lib') . DS . 'registry.php');
f::load(dir('lib') . DS . 'route.php');
f::load(dir('lib') . DS . 'translations.php');
f::load(dir('lib') . DS . 'helpers.php');

//====================================
//   Core
//====================================
f::load(dir() . 'core.php');
f::load(dir() . 'config.php');
f::load(dir() . 'routes.php');

//====================================
//   Modules
//====================================
f::load(dir('modules') . DS . 'assets.php');
f::load(dir('modules') . DS . 'html.php');
f::load(dir('modules') . DS . 'elements.php');
f::load(dir('modules') . DS . 'element.php');
f::load(dir('modules') . DS . 'components.php');
f::load(dir('modules') . DS . 'pattern.php');

//====================================
//   Patterns
//====================================
foreach(dir::read(dir('patterns')) as $file) {
  f::load(dir('patterns') . DS . $file);
}

//====================================
//   Elements
//====================================
foreach(dir::read(dir('elements', true)) as $file) {
  $kirby->set('panelBar', $file, dir('elements', true) . DS . $file);
}
