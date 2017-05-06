<?php

return [
  'title' => 'panelBar',
  'options' => [
    [
      'text' => 'Configure',
      'icon' => 'cog',
      'link' => purl('plugin/panel-bar')
    ]
  ],
  'html' => function() {
    $css = tpl::load(__DIR__ . DS . 'assets' . DS . 'css' . DS . 'widget.css');
    return '<style>' . $css . '</style>';
  }
];
