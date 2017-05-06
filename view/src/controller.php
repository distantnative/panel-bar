<?php

use Kirby\Panel\View;
use Kirby\Panel\Topbar;

use Kirby\Panel\Models\panelBar;

class panelBarController extends Kirby\Panel\Controllers\Base {

  public function config() {
    $bar = new panelBar;

    return $this->layout('app', [
      'topbar'     => new Topbar('panel-bar', $bar),
      'content'    => $this->view('src/view', [
        'bar'      => $bar,
        'elements' => $this->elements($bar),
        'status'   => $this->view('snippets/status', [
          'bar' => $bar
        ]),
        'settings' => $this->view('snippets/settings', []),
        'assets'   => $this->view('snippets/assets', [
          'path' => dirname(__DIR__) . DS . 'assets',
          'api'  => $bar->url()
        ])
      ])
    ]);
  }

  public function elements($bar) {
    return $this->view('snippets/elements', [
      'bar'        => $bar,
      'controller' => $this
    ]);
  }

  public function view($path, $data = []) {
    f::load(dirname(dirname(__DIR__)) . DS . 'core' . DS . 'translations' . DS . panel()->user()->language() . '.php');

    $view = new View($path, $data);
    $view->_root = dirname(__DIR__);
    return $view;
  }

}
