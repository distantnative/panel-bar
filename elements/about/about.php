<?php

namespace Kirby\panelBar;

class AboutElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
      // register overlay output and assets
      $this->component()->modal(['# About Headline1
Das hier ist etwas Text, der auch mal etwas länger werden könnte. Man müsste sich nun überlegen, was passiert, wenn dieser zu lang wird. Das hier ist etwas Text, der auch mal etwas länger werden könnte. Man müsste sich nun überlegen, was passiert, wenn dieser zu lang wird.
## About Headline2
Das hier ist etwas (link: projects: text: Text).
### About Headline3
Das hier ist etwas Text.
#### About Headline4
Das hier ist etwas Text.

Und ein zweiter Absatz.


##### About Headline5
Das hier ist etwas Text.',
null,
'Karl' => 'Crew']);

      // return pattern output
      return $this->pattern('link', [
        'id'    => $this->name(),
        'label' => 'About',
        'icon'  => 'compass',
        'url'   => '#'
      ]);
  }

}
