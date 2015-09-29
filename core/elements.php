<?php

namespace PanelBar;

use PanelBar\Helpers;

class Elements {

  public $site         = null;
  public $page         = null;

  public function __construct() {
    $this->site      = site();
    $this->page      = page();
  }

  public function panel() {
    return Helpers::link(array(
      'id'      => 'panel',
      'icon'    => 'cogs',
      'url'     => site()->url().'/panel',
      'label'   => 'Panel',
      'mobile'  => 'icon',
    ));
  }

  public function add() {
    return Helpers::dropdown(array(
      'id'     => 'add',
      'icon'   => 'plus',
      'label'  => 'Add',
      'items'  => array(
          'child' => array(
              'url'   => $this->site->url().'/panel/#/pages/add/'.$this->page->uri(),
              'label' => 'Child',
            ),
          'sibling' => array(
              'url'   => $this->site->url().'/panel/#/pages/add/'.$this->page->parent()->uri(),
              'label' => 'Sibling',
            ),
        ),
      'mobile' => 'icon'
    ));
  }

  public function edit() {
    return Helpers::link(array(
      'id'     => 'edit',
      'icon'   => 'pencil',
      'url'    => $this->site->url().'/panel/#/pages/show/'.$this->page->uri(),
      'label'  => 'Edit',
      'mobile' => 'icon',
    ));
  }

  public function toggle() {
    return Helpers::link(array(
      'id'     => 'toggle',
      'icon'   => $this->page->isVisible() ? 'toggle-on' : 'toggle-off',
      'url'    => $this->site->url().'/panel/#/pages/toggle/'.$this->page->uri(),
      'label'  => $this->page->isVisible() ? 'Visible' : 'Invisible',
      'mobile' => 'icon',
    ));
  }

  public function files($type = null) {
    $files  = $this->page->files();
    if (!is_null($type)) $files = $files->filterBy('type', '==', $type);
    $more   = $files->count() > 15;
    $files  = $files->limit(15);

    if ($files->count() > 0) {
      $items = array();
      foreach($files as $file) {
        $args = array(
          'type'      => $file->type(),
          'url'       => $this->site->url().'/panel/#/files/show/'.$this->page->uri().'/'.$file->filename(),
          'label'     => $file->filename(),
          'extension' => $file->extension(),
        );

        if ($file->type() == 'image') $args['image']  = $file->url();
        array_push($items, $args);
      }

      return Helpers::fileviewer(array(
        'id'     => 'files',
        'icon'   => ($type == 'image') ? 'photo' : 'file',
        'label'  => ($type == 'image') ? 'Images' : 'Files',
        'items'  => $items,
        'count'  => count($items),
        'more'   => $more ? $this->site->url().'/panel/#/files/index/'.$this->page->uri() : false,
        'mobile' => 'icon'
      ));
    }
  }

  public function images() {
    return $this->files('image');
  }

  public function languages() {
    if ($languages = $this->site->languages()) {
      $items = array();
      foreach($languages->not($this->site->language()->code()) as $language) {
        array_push($items, array(
          'url'   => $language->url().'/'.$this->page->uri(),
          'label' => strtoupper($language->code())
        ));
      }

      return Helpers::dropdown(array(
        'id'     => 'lang',
        'icon'   => 'flag',
        'label'  => strtoupper($this->site->language()->code()),
        'items'  => $items,
        'mobile' => 'label'
      ));
    }
  }

  public function loadtime() {
    return Helpers::label(array(
      'id'     => 'loadtime',
      'icon'   => 'clock-o',
      'label'  => number_format( ( microtime( true ) - $_SERVER['REQUEST_TIME_FLOAT'] ), 2 ),
      'mobile' => 'label',
    ));
  }

  public function logout() {
    return Helpers::link(array(
      'id'     => 'logout',
      'icon'   => 'power-off',
      'url'    => $this->site->url().'/panel/logout',
      'label'  => 'Logout',
      'mobile' => 'icon',
      'float'  => 'right',
    ));
  }

  public function user() {
    return Helpers::link(array(
      'id'     => 'user',
      'icon'   => 'user',
      'url'    => $this->site->url().'/panel/#/users/edit/'.$this->site->user(),
      'label'  => $this->site->user(),
      'mobile' => 'icon',
      'float'  => 'right',
    ));
  }

}
