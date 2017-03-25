<?php

return [
  'title' => 'panelBar',
  'options' => [
    [
      'text' => 'Default',
      'icon' => 'history',
      'link' => kirby()->urls()->index() . '/api/plugin/panel-bar-widget/reset'
    ]
  ],
  'html' => function() {
   return tpl::load(__DIR__ . DS . 'template' . DS . 'list.php', [
     'el'     => \Kirby\panelBar\Elements::all(),
     'active' => \Kirby\panelBar\Elements::active(),
     'url'    => kirby()->urls()->index() . '/api/plugin/panel-bar-widget/set',
     'assets' => __DIR__ . DS . 'assets' . DS
   ]);
  }
];
