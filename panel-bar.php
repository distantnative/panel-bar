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
$kirby->set('snippet', 'plugin.panelBar', $snippets . 'show.php');
$kirby->set('snippet', 'plugin.panelBar.hide', $snippets . 'hide.php');
$kirby->set('snippet', 'plugin.panelBar.main', $snippets . 'panelBar.php');
