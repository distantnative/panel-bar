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

    // register component
    $this->component()->overlay();
    $root = kirby()->roots()->site();

    // return output
    return $this->pattern('box', [
      'icon'  => 'info',
      'label' => 'Site',
      'box'   => [
        'Pages'       => [
          'label' => $this->site->index()->count(),
          'url'   => $this->site->url('subpages')
        ],
        'Files'       => $this->site->index()->files()->count(),
        'Templates'   => count(dir::read($root . DS . 'templates')),
        'Blueprints'  => count(\Kirby\Panel\Models\Page\Blueprint::all()),
        'Controllers' => count(dir::read($root . DS . 'controllers')),
        'Models'      => count(dir::read($root . DS . 'models')),
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

  //====================================
  //   Read version from package.json
  //====================================
  protected function version($path) {
    $root = kirby()->roots()->index();
    $json = json_decode(f::read($root . DS . $path . DS . 'package.json'));
    return $json->version;
  }

}
