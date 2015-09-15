<?php

class PanelBarCore {

  public $site         = null;
  public $page         = null;

  public $elements     = null;
  public $position     = null;
  public $visible      = true;

  public $includeCSS   = true;
  public $includeJS    = true;

  protected $protected = null;


  public function __construct($args = array()) {
    $args = $this->__defaultParameters($args);


    $this->elements   = c::get('panelbar.elements', $args['elements']);
    $this->position   = c::get('panelbar.position', 'top');
    $this->visible    = $args['hide'] !== true;
    $this->includeCSS = $args['css'];
    $this->includeJS  = $args['js'];

    $this->site      = site();
    $this->page      = page();
    $this->protected = array_diff(get_class_methods('PanelBarCore'), $this->elements);
  }


  // defaults for $args parameter
  protected function __defaultParameters($args) {
    return a::merge(array(
      'elements' => $this->elements,
      'css'      => true,
      'js'       => true,
      'hide'     => false,
    ), $args);
  }


  // Placeholder for static methods
  public static function defaults() { }
  public static function show()     { }
  public static function hide()     { }
  public static function css()      { }
  public static function js()       { }


  // Creating the output for the panel bar
  protected function __output($args = array()) {
    if ($user = site()->user() and $user->hasPanelAccess()) {

      $classes = 'panelbar '.$this->position.' '.($this->visible === false ? 'hidden' : '');
      $bar     = '<div class="'.$classes.'" id="panelbar">'.$this->__content().'</div>';
      $bar    .= $this->__controlBtn();

      if ($this->includeCSS) $bar .= $this->__getCSS();
      if ($this->includeJS)  $bar .= $this->__getJS();

      return $bar;
    }
  }

  protected function __content() {
    $content = '';
    foreach ($this->elements as $element) {
      // $element is custom function
      if (is_callable($element)) {
        $content .= call_user_func($element);

      // $element is default function
      } elseif (is_callable(array('self', $element)) and !in_array($element, $this->protected)) {
        $content .= call_user_func(array('self', $element));

      // $element is a string
      } elseif (is_string($element)) {
        $content .= $element;
      }
    }
    return $content;
  }


  // Output for control elements
  protected function __controlBtn() {
    $controls  = '<div class="panelbar__controls" id ="panelbar_control">';
    $controls .= $this->__flipBtn();
    $controls .= $this->__switchBtn();
    $controls .= '</div>';
    return $controls;
  }

  protected function __switchBtn() {
    $switch  = '<div class="panelbar__switch" id ="panelbar_switch">';
    $switch .= '<i class="fa fa-times-circle panelbar__switch--visible"></i>';
    $switch .= '<i class="fa fa-plus-circle panelbar__switch--hidden"></i>';
    $switch .= '<i class="fa fa-circle panelbar__switch--bg"></i>';
    $switch .= '</div>';
    return $switch;
  }

  protected function __flipBtn() {
    $flip  = '<div class="panelbar__flip" id ="panelbar_flip">';
    $flip .= '<i class="fa fa-arrow-circle-up panelbar__flip--top"></i>';
    $flip .= '<i class="fa fa-arrow-circle-down panelbar__flip--bottom"></i>';
    $flip .= '</div>';
    return $flip;
  }


  // Output the assets
  protected function __getCSS($position = null) {
    $style  = tpl::load(__DIR__ . DS . 'assets' . DS . 'css' . DS . 'panelbar.min.css');
    return '<style>'.$style.'</style>';
  }

  protected function __getJS() {
    $script  = 'siteURL="'.$this->site->url().'";';
    $script .= 'currentURI="'.$this->page->uri().'";';
    $script .= 'enhancedJS='.(c::get('panelbar.enhancedJS', false) ? 'true' : 'false').';';
    $script .= tpl::load(__DIR__ . DS . 'assets' . DS . 'js' . DS . 'panelbar.min.js');
    return '<script>'.$script.'</script>';
  }




  // Element Helpers

  // public helper functions to create elements
  public static function label($args) {
    $class  = 'panelbar__element panelbar__element--label '.self::__float($args).' pbel-'.$args['id'];
    $block  = '<div class="'.$classes.'">';
    $block .= '<span>';
    $block .= self::__icon($args);
    $block .= self::__label($args);
    $block .= '</span>';
    $block .= '</div>';
    return $block;
  }

  public static function link($args) {
    $class  = 'panelbar__element panelbar__element--btn '.self::__float($args).' pbel-'.$args['id'];
    $block  = '<div class="'.$class.'">';
    $block .= '<a href="'.$args['url'].'">';
    $block .= self::__icon($args);
    $block .= self::__label($args);
    $block .= '</a>';
    $block .= '</div>';
    return $block;
  }

  public static function dropdown($args) {
    $class  = 'panelbar__element panelbar__element--drop '.self::__float($args).' pbel-'.$args['id'];
    $block  = '<div class="'.$class.'">';

    // label
    $block .= '<span>';
    $block .= self::__icon($args);
    $block .= self::__label($args);
    $block .= '</span>';

    // all items
    $block .= '<div class="panelbar__dropitems">';
    foreach($args['items'] as $item) {
      $block .= '<a href="'.$item['url'].'" class="panelbar__dropitem">'.$item['label'].'</a>';
    }
    $block .= '</div>';

    $block .= '</div>';
    return $block;
  }

  public static function box($args) {
    $class  = 'panelbar__element panelbar__element--box '.self::__float($args).' pbel-'.$args['id'];
    $block  = '<div class="'.$class.'">';

    // label
    $block .= '<span>';
    $block .= self::__icon($args);
    $block .= self::__label($args);
    $block .= '</span>';

    // box content
    $block .= '<div class="panelbar__element--boxcontent" '.self::__style($args).'>';
    $block .= $args['content'];
    $block .= '</div>';

    $block .= '</div>';
    return $block;
  }


  // Helper methods for element helpers
  protected static function __icon($args) {
    if (isset($args['icon'])) {
      $icon  = '<i class="fa fa-'.$args['icon'];
      if (isset($args['mobile']) and $args['mobile'] == 'label') $icon .= ' not-mobile';
      $icon .= '"></i>';
      return $icon;
    }
  }

  protected static function __label($args) {
    if (isset($args['label'])) {
      $label  = '<span';
      if (!isset($args['mobile']) or $args['mobile'] == 'icon') $label .= ' class="not-mobile"';
      $label .= '">'.$args['label'].'</span>';
      return $label;
    }
  }

  protected static function __style($args) {
    if (isset($args['style'])) {
      $style  = ' style="';
      foreach ($args['style'] as $key => $value) {
        $style .= $key.': '.$value.';';
      }
      $style .= '"';
      return $style;
    }
  }

  protected static function __float($args) {
    return (isset($args['float']) and $args['float'] !== false) ? 'panelbar__element--right' : '';
  }




  // Default elements

  protected function panel() {
    return self::link(array(
      'id'      => 'panel',
      'icon'    => 'cogs',
      'url'     => site()->url().'/panel',
      'label'   => 'Panel',
      'mobile'  => 'icon',
    ));
  }

  protected function add() {
    return self::dropdown(array(
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

  protected function edit() {
    return self::link(array(
      'id'     => 'edit',
      'icon'   => 'pencil',
      'url'    => $this->site->url().'/panel/#/pages/show/'.$this->page->uri(),
      'label'  => 'Edit',
      'mobile' => 'icon',
    ));
  }

  protected function toggle() {
    return self::link(array(
      'id'     => 'toggle',
      'icon'   => $this->page->isVisible() ? 'toggle-on' : 'toggle-off',
      'url'    => $this->site->url().'/panel/#/pages/toggle/'.$this->page->uri(),
      'label'  => $this->page->isVisible() ? 'Visible' : 'Invisible',
      'mobile' => 'icon',
    ));
  }

  protected function user() {
    return self::link(array(
      'id'     => 'user',
      'icon'   => 'user',
      'url'    => $this->site->url().'/panel/#/users/edit/'.$this->site->user(),
      'label'  => $this->site->user(),
      'mobile' => 'icon',
      'float'  => 'right',
    ));
  }

  protected function logout() {
    return self::link(array(
      'id'     => 'logout',
      'icon'   => 'power-off',
      'url'    => $this->site->url().'/panel/logout',
      'label'  => 'Logout',
      'mobile' => 'icon',
      'float'  => 'right',
    ));
  }

  protected function languages() {
    if ($languages = $this->site->languages()) {
      $items = array();
      foreach($languages->not($this->site->language()->code()) as $language) {
        array_push($items, array(
          'url'   => $language->url().'/'.$this->page->uri(),
          'label' => strtoupper($language->code())
        ));
      }

      return self::dropdown(array(
        'id'     => 'lang',
        'icon'   => 'flag',
        'label'  => strtoupper($this->site->language()->code()),
        'items'  => $items,
        'mobile' => 'label'
      ));
    }
  }


}
