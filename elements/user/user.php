<?php

namespace Kirby\panelBar;

class UserElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    if($user = $this->site->user()) {
      // register overlay output and assets
      $this->component()->overlay();

      // return pattern output
      return $this->pattern('link', [
        'id'    => $this->name(),
        'label' => $user,
        'icon'  => 'user',
        'url'   => $user->url('edit'),
        'title' => 'User: ' . $user,
        'right' => true,
      ]);
    }
  }

}
