<?php

// =============================================
//  Element assets
// =============================================

kirby()->set('route', [
  'pattern' => 'assets/plugins/panel-bar/(:any)/elements/(:any)/(:all)',
  'action'  => function($type, $element, $asset) {
    $root = dirname(__DIR__) . DS . 'elements' . DS . $element . DS . 'assets' . DS . $type . DS . $asset;
    return new \Response(f::read($root), f::extension($root));
  },
  'method' => 'GET'
]);


// =============================================
//  Element routes
// =============================================
$root = dirname(__DIR__) . DS;
foreach(dir::read($root . 'elements') as $element) {
  $file = $root . 'elements' . DS . $element . DS . 'routes.php';
  if(f::exists($file)) {
    $route = require($file);
    new Kirby\panelBar\Route($element, $route);
  }
}
