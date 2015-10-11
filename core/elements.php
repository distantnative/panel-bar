<?php

namespace PanelBar;

use PanelBar\PB;
use PanelBar\Build;

class Elements {

  public $site;
  public $page;

  protected $output;
  protected $templates;
  protected $assets;
  protected $css;
  protected $js;

  public function __construct($output, $assets) {
    $this->site   = site();
    $this->page   = page();

    $this->output = $output;
    $this->assets = $assets;
  }


  /**
   *  PANEL
   */

  public function panel() {
    return Build::link(array(
      'id'      => __FUNCTION__,
      'icon'    => 'cogs',
      'url'     => pb::url(''),
      'label'   => 'Panel',
      'title'   => 'Alt + P',
    ));
  }


  /**
   *  ADD
   */

  public function add() {
    $this->_registerIframe();

    return Build::dropdown(array(
      'id'     => __FUNCTION__,
      'icon'   => 'plus',
      'label'  => 'Add',
      'items'  => array(
          'child' => array(
              'url'   => pb::url('add', $this->page),
              'label' => 'Child',
            ),
          'sibling' => array(
              'url'   => pb::url('add', $this->page->parent()),
              'label' => 'Sibling',
            ),
        ),
    ));
  }


  /**
   *  EDIT
   */

  public function edit() {
    $this->_registerIframe();

    return Build::link(array(
      'id'     => __FUNCTION__,
      'icon'   => 'pencil',
      'url'    => pb::url('show', $this->page),
      'label'  => 'Edit',
      'title'  => 'Alt + E',
    ));
  }


  /**
   *  TOGGLE
   */

  public function toggle() {
    // register assets
    $this->assets->setHook('css', pb::load('css', 'elements/toggle.css'));

    if(!pb::version("2.2.0")) {
      $js = 'currentURI="'.$this->page->uri().'";siteURL="'.$this->site->url().'";';
      $this->assets->setHook('js',  pb::load('js', 'elements/toggle.min.js'));
      $this->assets->setHook('js',  $js);
    } else {
      $this->_registerIframe();
      $this->assets->setHook('js',  'panelbarIframe.init([".panelbar--toggle a"]);');
    }


    if($this->page->isInvisible() and !pb::version("2.2.0")) {
      // prepare output
      $siblings = array();
      array_push($siblings, array(
        'url'   => pb::url('toggle', $this->page),
        'label' => '&rarr;<span class="gap"></span>&larr;',
        'title' => 'Publish page at this position'
      ));
      foreach ($this->page->siblings()->visible() as $sibling) {
        array_push($siblings, array('label' => $sibling->title()));
        array_push($siblings, array(
          'url'   => pb::url('toggle', $this->page),
          'label' => '&rarr;<span class="gap"></span>&larr;',
          'title' => 'Publish page at this position'
        ));
      }

      return Build::dropdown(array(
        'id'      => __FUNCTION__,
        'icon'    => 'toggle-off',
        'label'   => 'Invisible',
        'items'   => $siblings,
        'compact' => false,
      ));

    } else {
      return Build::link(array(
        'id'      => __FUNCTION__,
        'icon'    => $this->page->isVisible() ? 'toggle-on' : 'toggle-off',
        'label'   => $this->page->isVisible() ? 'Visible' : 'Invisible',
        'url'     => pb::url('toggle', $this->page),
        'compact' => false,
      ));
    }
  }


  /**
   *  FILES
   */

  public function files($type = null, $function = null) {
    if ($files = $this->_files($type)) {

      if    (count($files) > 12)    $count = '12more';
      elseif(count($files) == 2)    $count = 2;
      elseif(count($files) == 1)    $count = 1;
      else                          $count = 'default';

      return Build::fileviewer(array(
        'id'     => is_null($function) ? __FUNCTION__ : $function,
        'icon'   => ($type == 'image') ? 'photo' : 'file',
        'label'  => ($type == 'image') ? 'Images' : 'Files',
        'items'  => $files,
        'count'  => $count,
        'all'    => pb::url('index', $this->page->files()->first()),
      ));
    }
  }


  /**
   *  IMAGES
   */

  public function images() {
    return $this->files('image', __FUNCTION__);
  }


  /**
   *  FILELIST
   */

  public function filelist($type = null, $function = null) {
    if ($files = $this->_files($type)) {
      return Build::filelist(array(
        'id'     => is_null($function) ? __FUNCTION__ : $function,
        'icon'   => 'th-list',
        'label'  => ($type == 'image') ? 'Images' : 'Files',
        'items'  => $files,
        'all'    => pb::url('index', $this->page->files()->first()),
      ));
    }
  }


  /**
   *  IMAGELIST
   */

  public function imagelist() {
    return $this->filelist('image', __FUNCTION__);
  }


  /**
   *  LANGUAGES
   */

  public function languages() {
    if ($languages = $this->site->languages()) {
      // prepare output
      $items = array();
      foreach($languages->not($this->site->language()->code()) as $language) {
        array_push($items, array(
          'url'   => $language->url() . '/' . $this->page->uri(),
          'label' => strtoupper($language->code())
        ));
      }

      // register output
      return Build::dropdown(array(
        'id'     => __FUNCTION__,
        'icon'   => 'flag',
        'label'  => strtoupper($this->site->language()->code()),
        'items'  => $items,
        'mobile' => 'label'
      ));
    }
  }


  /**
   *  LOADTIME
   */

  public function loadtime() {
    return Build::label(array(
      'id'     => __FUNCTION__,
      'icon'   => 'clock-o',
      'label'  => number_format((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'] ), 2 ),
      'mobile' => 'label',
    ));
  }


  /**
   *  USER
   */

  public function user() {
    $this->_registerIframe();

    return Build::link(array(
      'id'      => __FUNCTION__,
      'icon'    => 'user',
      'url'     => pb::url('edit', $this->site->user()),
      'label'   => $this->site->user(),
      'compact' => false,
      'float'   => 'right',
    ));
  }


  /**
   *  LOGOUT
   */

  public function logout() {
    return Build::link(array(
      'id'      => __FUNCTION__,
      'icon'    => 'power-off',
      'url'     => pb::url('logout'),
      'label'   => 'Logout',
      'compact' => false,
      'float'   => 'right',
    ));
  }




  /**
   *  TOOL: iFrame
   */

  private function _registerIframe() {
    // register assets
    $this->assets->setHook('js',  pb::load('js',  'components/iframe.min.js'));
    $this->assets->setHook('css', pb::load('css', 'components/iframe.css'));

    // register output
    $this->output->setHook('before',   pb::load('html', 'iframe/iframe.php'));
    $this->output->setHook('elements', pb::load('html', 'iframe/btn.php'));
  }


  /**
   *  TOOL: Files
   */

  private function _files($type = null) {
    $files = $this->page->files();

    if (!is_null($type)) {
      $files = $files->filterBy('type', '==', $type);
    }

    if ($files->count() > 0) {
      $items = array();
      foreach($files as $file) {
        $args = array(
          'type'      => $file->type(),
          'url'       => pb::url('show', $file),
          'label'     => $file->name(),
          'extension' => $file->extension(),
          'size'      => $file->niceSize(),
        );

        if ($file->type() == 'image') $args['image']  = $file->url();
        array_push($items, $args);
      }

      return $items;

    } else {
      return false;
    }
  }


}
