<?php

namespace Kirby\panelBar;

use Dir;
use F;

class SystemElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    // register assets
    $this->asset('css', 'system.css');
    $this->asset('js',  'system.min.js');

    $this->component()->overlay();

    $root = dirname(dirname(dirname(dirname(__DIR__)))) . DS;

    // return output
    return $this->pattern('box', [
      'id'    => $this->name(),
      'icon'  => 'info',
      'label' => 'Site',
      'box'   => [
        'Pages'       => [
          'label' => $this->site->index()->count(),
          'url'   => $this->site->url('subpages')
        ],
        'Files'       => $this->site->index()->files()->count(),
        'Templates'   => count(dir::read($root . 'templates')),
        'Blueprints'  => count(\Kirby\Panel\Models\Page\Blueprint::all()),
        'Controllers' => count(dir::read($root . 'controllers')),
        'Models'      => count(dir::read($root . 'models')),
        null,
        'Kirby'    => [
          'label'    => \Kirby::version(),
          'url'      => null,
          'external' => true
        ],
        'Panel'    => [
          'label'    => $this->version('panel'),
          'url'      => null,
          'external' => true
        ],
        'Toolkit'  => [
          'label'    => \Toolkit::version(),
          'url'      => null,
          'external' => true
        ],
        'panelBar' => [
          'label'    => Core::$version,
          'url'      => null,
          'external' => true
        ]
      ]
    ]);
  }

  protected function version($path) {
    $root = kirby()->roots()->index() . DS;
    return json_decode(f::read($root . $path . DS . 'package.json'))->version;
  }

}
