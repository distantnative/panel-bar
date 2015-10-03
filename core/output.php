<?php

namespace PanelBar;

use C;

use PanelBar\PB;

class Output extends Hooks {

  public $before;
  public $elements;
  public $after;

  protected $visible;
  protected $position;


  public function __construct($visible) {
    $this->before    = array();
    $this->elements  = array();
    $this->after     = array();

    $this->visible   = $visible;
    $this->position  = c::get('panelbar.position', 'top');
  }


  public function get() {
    return pb::load('html', 'main.php', array(
      'class'    => 'panelbar panelbar--' . $this->position .
                    ($this->visible === false ? ' panelbar--hidden' : ''),
      'before'   => $this->getHooks('before'),
      'elements' => $this->getHooks('elements'),
      'after'    => $this->getHooks('after'),
    ));
  }

}
