<?php

// =============================================
//  Load class
// =============================================
require_once('core/bootstrap.php');

// =============================================
//  Register snippets
// =============================================
$snippets = __DIR__  . DS . 'core' . DS . 'snippets' . DS;
$kirby->set('snippet', 'plugin.panelBar',      $snippets . 'panelBar.php');
$kirby->set('snippet', 'plugin.panelBar.hide', $snippets . 'hide.php');

// =============================================
//  Register panel view & add route
// =============================================
if(c::get('panelBar.widget', true)) {
  $kirby->set('widget', 'panel-bar', __DIR__ . '/view');
  require_once('view/route.php');
}
