<?php

f::load(dirname(__DIR__) . DS . 'core' . DS . 'translations' . DS . panel()->user()->language() . '.php');

return [
  'title' => 'panelBar',
  'options' => [
    [
      'text' => l('panelBar.view.configure'),
      'icon' => 'cogs',
      'link' => purl('plugin/panel-bar')
    ]
  ],
  'html' => function() {
    $css = tpl::load(__DIR__ . DS . 'assets' . DS . 'css' . DS . 'widget.css');
    return '<style>' . $css . '</style>';
  }
];
