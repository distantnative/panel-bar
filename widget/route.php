<?php

if(function_exists('panel') && $panel = panel()) {

  $panel->routes = array_merge([
    [
      'pattern' => 'plugin/panel-bar',
      'action'  => function() {
        require 'view/controller.php';
        require 'view/model.php';

        $controller = new panelBarController;
        echo $controller->config();
      },
      'method'  => 'GET|POST'
    ],
  ], $panel->routes);

}
