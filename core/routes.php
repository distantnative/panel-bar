<?php

$kirby = kirby();

// =============================================
//  Element assets
// =============================================
$kirby->set('route', [
  'pattern' => 'assets/plugins/panel-bar/(:any)/elements/(:any)/(:all)',
  'action'  => function($type, $element, $asset) {
    $root = dirname(__DIR__) . DS . 'elements' . DS . $element;
    $dir  = $root . DS . 'assets' . DS . $type . DS . $asset;
    return new \Response(f::read($dir), f::extension($root));
  },
  'method' => 'GET'
]);


// =============================================
//  Element routes
// =============================================
$root = dirname(__DIR__) . DS . 'elements';
foreach(dir::read($root) as $element) {
  if($file = $root . DS . $element . DS . 'routes.php' and f::exists($file)) {
    $route = require($file);
    new Kirby\panelBar\Route($element, $route);
  }
}

// =============================================
//  Widget routes
// =============================================
$kirby->set('route', [
  'pattern' => 'api/plugin/panel-bar-widget/set',
  'action'  => function() {
    return \Kirby\panelBar\Elements::set(get('elements'));
  },
  'method' => 'POST'
]);

$kirby->set('route', [
  'pattern' => 'api/plugin/panel-bar-widget/reset',
  'action'  => function() {
    return \Kirby\panelBar\Elements::clear();
  },
  'method' => 'POST'
]);
