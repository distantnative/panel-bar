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
  $file = $root . DS . $element . DS . 'routes.php';
  if(f::exists($file)) {
    $route = require($file);
    new Kirby\panelBar\Route($element, $route);
  }
}

// =============================================
//  Widget routes
// =============================================
$kirby->set('route', [
  'pattern' => 'api/plugin/panel-bar/set',
  'action'  => function() {
    if($user = site()->user() and $user->hasPanelAccess()) {
      $elements = [];

      foreach(get('elements') as $element) {
        $elements[$element['element']] = [];

        if($element['float']) {
          $elements[$element['element']]['float'] = $element['float'];
        }
      }

      $config = new \Kirby\panelBar\Config;
      return $config->set($elements);
    }
  },
  'method' => 'POST'
]);

$kirby->set('route', [
  'pattern' => 'api/plugin/panel-bar/reset',
  'action'  => function() {
    if($user = site()->user() and $user->hasPanelAccess()) {
      $config = new \Kirby\panelBar\Config;
      return $config->clear();
    }
  },
  'method' => 'POST'
]);
