<?php

namespace panelBar\Elements;

require_once(__DIR__ . '/../../vendors/github/client/GitHubClient.php');

use panelBar\Pattern;
use panelBar\Assets;
use C;
use Toolkit;
use Kirby;

class System extends \panelBar\Element {

  //====================================
  //   HTML output
  //====================================

  public function html() {
    // register assets
    $this->assets->setHook('css', $this->css('system'));

    // return output
    return pattern::box(array(
      'id'    => $this->getElementName(),
      'icon'  => 'info',
      'label' => 'System',
      'box'   => $this->content()
    ));
  }

  //====================================
  //   Box content
  //====================================

  private function content() {
    $content  = '<ul>';
    foreach(array('Kirby', 'Toolkit', 'Panel') as $system) {
      $content .= $this->tpl('list-entry', array(
        'system'  => $system,
        'version' => $this->getVersionFrom($system)
      ));
    }
        $content .= '</ul>';
    return $content;
  }

  //====================================
  //   Helpers
  //====================================

  private function getVersionFrom($repo) {

    // get from GitHub API if activated
    if(c::get('panelbar.system.api', true)) {
      if(!isset($this->github)) {
        $this->github = new \GitHubClient();
      }

      $api      = $this->github->repos->listTags('getkirby', $repo);
      $version  = $api[0]->getName();
      $status   = $version == $repo::version() ? 'same' : 'older';
    } else {
      $status   = 'unknown';
    }

    return $this->tpl('version-number', array(
      'status'  => $status,
      'version' => $repo::version()
    ));
  }

}
