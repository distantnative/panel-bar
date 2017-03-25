<?php

// =============================================
//  Load class
// =============================================
require_once('core/bootstrap.php');

// =============================================
//  Register snippets
// =============================================
$snippets = __DIR__ . DS . 'snippets' . DS;
$kirby->set('snippet', 'plugin.panelBar',      $snippets . 'panelBar.php');
$kirby->set('snippet', 'plugin.panelBar.hide', $snippets . 'hide.php');

// =============================================
//  Register widget
// =============================================
if(c::get('panelBar.widget', true)) {
  $kirby->set('widget', 'panel-bar', __DIR__ . '/widget');
}
