<?php

namespace Kirby\panelBar;

class UserElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    if($user = $this->site->user()) {
      // register overlay output and assets
      $this->withOverlay();
      
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
