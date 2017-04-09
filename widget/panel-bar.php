<?php

$config = new \Kirby\panelBar\Config;

return [
  'title' => 'panelBar Elements',
  'options' => [
    [
      'text' => 'Default Set',
      'icon' => 'history',
      'link' => kirby()->urls()->index() . '/api/plugin/panel-bar-widget/reset'
    ]
  ],
  'html' => function() use($config) {
    $template = __DIR__ . DS . 'template' . DS . 'list.php';

   return tpl::load($template, [
     'config' => $config,
     'el'     => \Kirby\panelBar\Elements::all(),
     'active' => $config->elements(),
     'url'    => kirby()->urls()->index() . '/api/plugin/panel-bar-widget/set',
     'assets' => __DIR__ . DS . 'assets'
   ]);
  }
];
