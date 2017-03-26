<?php

namespace Kirby\panelBar;

class AboutElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
      // register overlay output and assets
      $this->component()->modal([
        '# panelBar ' . Core::$version . '
panelBar is a plugin for (link: https://getkirby.com text: Kirby CMS). It is maintained by (link: https://github.com/distantnative text: Nico Hoffmann).
#### Issues, ideas or questions?
If you encounter any bugs, have suggestions for features to add or simply do not know how to work with an element, head over and open (link: https://github.com/distantnative/panel-bar/issues text: a new issue).'
      ]);

      // return pattern output
      return $this->pattern('link', [
        'id'    => $this->name(),
        'label' => null,
        'icon'  => 'id-card-o',
        'url'   => '#modal',
        'right' => true
      ]);
  }

}
