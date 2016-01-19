<?php

namespace panelBar;

class Hooks {

  //====================================
  //   Add $hook to the $type queue
  //====================================

  public function setHook($type, $hook) {
    if(!in_array($hook, $this->{$type}, true)) {
      array_push($this->{$type}, $hook);
    }
  }

  //====================================
  //   setHook on all elements of multi-dimensional array
  //====================================

  public function setHooks($collection) {
    if(is_array($collection)) {
      foreach($collection as $type => $hooks) {
        if(is_array($hooks)) {
          foreach($hooks as $hook) {
            $this->setHook($type, $hook);
          }
        } elseif(is_string($hooks)) {
          $this->setHook($type, $hooks);
        }
      }
    }
  }

  //====================================
  //   Return all hooked partes from $type queue
  //====================================

  protected function getHooks($type) {
    $return = '';
    foreach($this->{$type} as $hook) {
      if(is_callable($hook)) {
        $return .= call_user_func($hook);
      } elseif(is_string($hook)) {
        $return .= $hook;
      }
    }
    return $return;
  }

}
