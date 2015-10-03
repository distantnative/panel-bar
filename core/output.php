<?php

namespace PanelBar;

use C;
use Tpl;

class Output extends Hooks {

  public $before;
  public $elements;
  public $after;

  public $templates;

  protected $visible;
  protected $position;


  public function __construct($visible) {
    $this->before    = array();
    $this->elements  = array();
    $this->after     = array();

    $this->visible   = $visible;
    $this->position  = c::get('panelbar.position', 'top');

    $this->templates = realpath(__DIR__ . '/..') . DS . 'templates' . DS;
  }


  public function get() {
    return tpl::load($this->templates . 'main.php', array(
      'class'    => 'panelbar panelbar--' . $this->position .
                    ($this->visible === false ? ' panelbar--hidden' : ''),
      'before'   => $this->getHooks('before'),
      'elements' => $this->getHooks('elements'),
      'after'    => $this->getHooks('after'),
    ));
  }

}
