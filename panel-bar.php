<?php

// =============================================
//  Load class
// =============================================

require_once('core/bootstrap.php');


// =============================================
//  Register snippets
// =============================================

$kirby    = kirby();

$snippets = __DIR__ . DS . 'snippets' . DS;
$kirby->set('snippet', 'plugin.panelBar',      $snippets . 'panelBar.php');
$kirby->set('snippet', 'plugin.panelBar.hide', $snippets . 'hide.php');

$kirby->set('route', [
  'pattern' => 'assets/plugins/panel-bar/(:any)/elements/(:any)/(:all)',
  'action'  => function($type, $element, $asset) {
    $root = __DIR__ . DS . 'elements' . DS . $element . DS . 'assets' . DS . $type . DS . $asset;
    return new \Response(f::read($root), f::extension($root));
  },
  'method' => 'GET'
]);
