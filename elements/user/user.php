<?php

namespace Kirby\panelBar;

class UserElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    if($user = $this->site->user()) {
      // register iFrame output and assets
      $this->withFrame();

      // return pattern output
      return $this->pattern('link', [
        'id'    => $this->name(),
        'label' => $user,
        'icon'  => 'user',
        'url'   => $user->url('edit'),
        'right' => true
      ]);
    }
  }

}