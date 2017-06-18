![panelBar for Kirby CMS](http://distantnative.com/remote/github/kirby-panelbar.png)  

[![Release](https://img.shields.io/github/release/distantnative/panel-bar.svg)](https://github.com/distantnative/panel-bar/releases)  [![Issues](https://img.shields.io/github/issues/distantnative/panel-bar.svg)](https://github.com/distantnative/panel-bar/issues) ![Kirby Version](https://img.shields.io/badge/Kirby-2.4.1%2B-red.svg)


panelBar includes a toolbar on top of your site which gives you direct access to [administrative functions](#StandardElements). panelBar will only be visible to logged in users who are eligible to access the panel.

*Requires PHP 5.5+ and Kirby 2.4.1 or higher*


![panelBar - Images element](https://nhoffmann.com/remote/github/panel-bar/images-element.png)  


&nbsp;  

# Table of Contents
1.  [Setup](#Setup)
2.  [Usage](#Usage)
3.  Elements
    1. [Standard Elements](#StandardElements)
    2. [Default Set of Elements](#DefaulSet)
    3.  [Custom Set of Elements](#CustomSet)
4.  [Custom Elements](#CustomElements)
    1. [Element Patterns](#Patterns)
    2. [Custom CSS/JS](#CustomCSSJS)
    3. [Routes](#Routes)
    4. [Translations](#Translations)
    5. [Using Components](#Components)
    6. [CSS & JS Guide](GUIDE.md)
5.  Options
    1. [Default Position](#OptionPosition)
    2. [Login Icon](#OptionLogin)
    3. [Keyboard Shortcuts](#OptionKeyboard)
6.  [Known Problems](#Problems)
7.  [Help & Improve](#Help)
8.  [Changelog](CHANGELOG.md)

&nbsp;  

# Setup<a id="Setup"></a>

#### With the [Kirby CLI](https://github.com/getkirby/cli)
```
kirby plugin:install distantnative/panel-bar
```

#### Manually
1. Download the [panelBar plugin](https://github.com/distantnative/panel-bar/zipball/master/)
2. Copy the folder to `site/plugins/panel-bar`

&nbsp;  

# Usage <a id="Usage"></a>
Include in your `site/snippets/footer.php` (or equivalent) before the `</body>` tag:
```php
<?php snippet('plugin.panelBar') ?>
```

If you want to hide the panelBar per-default at page load:
```php
<?php snippet('plugin.panelBar.hide') ?>
```

If you use **caching with Kirby**, please make sure to only activate it if the visitor is not a logged-in user:
```php
if(!site()->user()) c::set('cache', true);
```

&nbsp;  

# Elements

## Standard Elements <a id="StandardElements"></a>
The panelBar provides several standard elements:  

Name                                | Description
----------------------------------- | ----------------------------------------
[`add`](elements/add)               | Add page as sibling or child
[`edit`](elements/edit)             | Edit current page
[`files`](elements/files)           | List of files of the current page
[`images`](elements/images)         | Viewer for images of the current page
[`index`](elements/index)           | List of all pages (index)
[`languages`](elements/languages)   | Dropdown to switch between site languages
[`loadtime`](elements/loadtime)     | Info label for loading time
[`logout`](elements/logout)         | Sign out current user
[`navigation`](elements/navigation) | Navigate between parent, siblings and children pages
[`pagespeed`](elements/pagespeed)   | Google PageSpeed API
[`panel`](elements/panel)           | Open the Kirby panel
[`system`](elements/system)         | Info box incl. version checks for kirby, toolkit and panel
[`user`](elements/user)             | Current user
[`visibility`](elements/visibility) | Change the visibility of the current page (hide/publish)


### Default Set of Elements <a id="DefaultSet"></a>
The pre-defined default set of elements consists of [`panel`](elements/panel)  , [`add`](elements/add)  , [`edit`](elements/edit)  , [`visibility`](elements/visibility)  , [`files`](elements/files)  , [`user`](elements/user)   and [`logout`](elements/logout)  . You can define your own [custom set of elements](#CustomSet).

![Default set of Elements](https://nhoffmann.com/remote/github/panel-bar/standard-elements.png)

### Custom Set of Elements <a id="CustomSet"></a>
You can define a custom set of elements in `site/config/config.php`:
```php
c::set('panelbar.elements', [
  'panel'.
  'add',
  'edit',
  …
]);
```

Or directly in panelBar's own config file `site/config/panelBar.yml`:
```ini
panel:
add:
edit:
  float: right
…
```

This config file can also be edited right from the panelBar panel widget:

![Widget](https://nhoffmann.com/remote/github/panel-bar/widget.png)

You can deactivate the panel widget with this option:
```php
c::set('panelBar.widget', false);
```

&nbsp;

# Custom Elements <a id="CustomElements"></a>
panelBar is designed to be modular and can include your own custom elements. A custom element can be included as a Kirby plugin, consisting at least of a folder and a PHP file with the same name. The file needs to contain the following basic structure:

```php
<?php

namespace Kirby\panelBar;

class CustomElement extends Element {

  public function render() {
    return 'your HTML output';
  }

}
```

Class naming is crucial: it consists of the name of the element (like the folder and file) followed by `Element`, e.g. the [`edit`](elements/edit) element is defined as the `EditElement` class. Take a look at [`EditElement`](elements/edit) or [`LoadtimeElement`](elements/loadtime).

You can register the custom element to be used by the panelBar:
```php
if(kirby()->plugin('panel-bar')) {
  kibry()->set('panelBar', 'customElement', 'path/to/element/folder');
}
```

## Element Patterns <a id="Patterns"></a>
To make it a bit simpler to create custom elements, panelBar offers three patterns that can be resused and returned in `Element::render()`:

```php
return $this->pattern($type, [
  'id'      => $this->name(),
  'label'   => '',        // label of the toolbar entry
  'icon'    => 'pencil',  // icon of the toolbar entry
  'class'   => null,      // additional CSS classes
  'url'     => null,      // URL of button, if null simple text label
  'mobile'  => 'icon',    // reponsive is shown 'icon' or 'label'
  'title'   => null,      // hover title
  'right'   => false      // should it be aligned to the right?
  …
]);
```

All of them share some arguments (see above), but the specific types also have some specific arguments based on their nature:

**[`link`](core/patterns/link.php)**  
Simple label or link button (e.g. the [`user`](elements/user) element). No additional arguments.

**[`dropdown`](core/patterns/dropdown.php)**  
Simple dropdown list (e.g. the [`add`](elements/add) element). Additional argument `icons` with an array of the list entries:

```php
return $this->pattern('dropdown', [
  'id'    => $this->name(),
  'label' => 'Add',
  'icon'  => 'plus',
  'items' => [
    [
      'url'   => $this->page->url('add'),
      'label' => 'Child',
    ],
    [
      'url'      => $this->page->parent->url('add'),
      'label'    => 'Sibling',
      'external' => true
    ]
  ]
]);
```

**[`box`](core/patterns/box.php)**  
Simple box for HTML content. Offers pre-defined template for information (as used by the [`system`](elements/system) element). Important is the additional `box` argument:

```php
return $this->pattern('box', [
  'id'    => $this->name(),
  'icon'  => 'info',
  'label' => 'Info box',
  'box'   => 'My box content <b>:)</b>'
]);
```

![System element](https://nhoffmann.com/remote/github/panel-bar/system-element.png)


You can also provide an array instead of a string to get a pre-styled box generated by the content component (see below).

## Custom CSS/JS <a id="CustomCSSJS"></a>
For a custom plugin, it might be vital to include custom CSS or JS as well. Those should be stored within the custom element folder in a subfolder called `assets/css` or `assets/js`. panelBar offers simple method calls to include those custom assets which can be called e.g. in  `render()`:

```php
public function render() {
  $this->asset('css', 'system.css');
  $this->asset('js',  'system.min.js');
  …
}
```

Have a look at panelBar's [assets guide](GUIDE.md) on its core CSS and Javascript elements.

## Routes <a id="Routes"></a>
Routes for custom element can be set by including a file called `routes.php` in the custom element folder, which has to be structured as follows:

```php
<?php

return [
  'pattern' => '(:any)/(:all)',
  'action'  => function($action, $uri) {
    …
  },
  'method' => 'GET'
];
```

panelBar will prefix the pattern. In order to retrieve the full route URL, you can use the `$this->route($pattern)` from within your element class.

Check out the `visibility` element as an example.

## Translations <a id="Translations"></a>
panelBar offers a way to make your custom element strings translatable. Include a folder called `translations` in your custom element folder. You need to put a file for each language with the locale as file name (e.g. `de.php`). English is always the fallback language, so if you offer translations, always include the `en.php`:

```php
<?php

l::set('panelBar.element.visibility.visible', 'Visible');
l::set('panelBar.element.visibility.invisible',  'Invisible');
```

The pattern of the key always needs to be `panelBar.element.[NAME OF ELEMENT].[CUSTOM KEY]`. Inside your custom element class, you can get the right translation by using `$this->l($key)`.


## Using Components <a id="Components"></a>
panelBar comes bundled with some components that you can also use for your custom element.

### Overlay
The main component is the overlay, which loads the actual panel page in an iframe. You can very easily use it yourself:

```php
public function render() {
  $this->component()->overlay();
  …
}
```

Now all thinks inside your element will be loaded in the overlay. If you want some links to exclude from this behaviour, just make sure they feature the `.external` class.

### Modal
The modal component offers a simple way for your panelBar element to open a modal overlay:

```php
public function render() {
    $this->component()->modal('This is the modal content');

    return $this->pattern('link', [
      'label' => 'About',
      'icon'  => 'compass',
      'url'   => '#modal'
    ]);
}
```

You have to make sure that your panelBar element contains a link with the `href` attribute `#modal`. For the modal content it might be helpful to use the content component (see below).


### Content
The content component helps you to turn an array of contents into a pre-styled text:

```php
$this->component()->content([
  '# About Headline1
This text is a little longer, because at some point we have to find out what happens when text gets so long, even though stylistically it is not really advisable to write such long sentences as they do vastly diminish the capacity of their readers to fully understand what has been written which obviously works strongly against the intention of writing anything – especially such a long sentence – in the first place.
## About Headline2
That is a text with a (link: projects: text: link).
### About Headline3
Just some text.
#### About Headline4
Just some text – a real copy cat.

Oh and another paragraph

##### About Headline5
This is the final countdown.',
  null,
  'Karls' => 'Crew',
  'Favorite Video' => [
    'label'    => 'this gem',
    'url'      => 'https://www.youtube.com/watch?v=d-mYX0qKkB8',
    'external' => true
  ]
]);
```

You can see text elements and styles featured in this example:
- a string without a key will parsed as Kirbytext
- `null` will result in a horizontal line
- a key-value pair will be listed next to each other
- a key-array pair will look the same, but offers the possibility to set the value as a link

![Content component in modal](https://nhoffmann.com/remote/github/panel-bar/modal.png)

### Count
Another component is a simple count badge which can be used like this:

```php
public function render() {
  return $this->pattern('link', [
    'label'   => 'Messages' . $this->component()->count($collection),
    …
```

&nbsp;  

# Options
All options refer to settings in the `site/config/config.php`.

### Default Position <a id="OptionPosition"></a>
To change the default position of the panelBar to bottom include:
```php
c::set('panelBar.position', 'bottom');
```

### Login Icon <a id="OptionLogin"></a>
If the visitor is not logged-in to the panel, instead of the panelBar a sign-in icon is shown on the bottom-right of the page. To activate that icon include:
```php
c::set('panelBar.login', true);
```

### Keyboard Shortcuts <a id="OptionKeyboard"></a>
By default the panelBar features a few keyboard shortcuts:  

Keyboard Shortcut    | Effect
-------------------- | -------------
`alt` + `X`          | Toggle visibility (show/hide)
`alt` + `-` (dash)   | Toggle position (top/bottom)
`alt`+ `up arrow`    | Set position to top
`alt` + `down arrow` | Set position to bottom
`alt` + `M`          | Open Edit mode
`alt` + `P`          | Open the Kirby panel

You can deactivate those:
```php
c::set('panelBar.keys', false);
```

&nbsp;  

# Known Problems <a id="Problems"></a>
**X-Frame-Options**  
If you have set the `X-Frame-Options` in your `.htaccess` to `DENY`, panelBar will not be able to display the panel in its embedded overlay mode. panelBar tries to detect this barrier and then switch to plain links.

&nbsp;  

# Help & Improve <a id="Help"></a>
If you find any bugs, have troubles or ideas for new elements or further configuration options, please let me know [by opening a new issue](https://github.com/distantnative/panel-bar/issues/new).

&nbsp; 

# License
[MIT License](http://www.opensource.org/licenses/mit-license.php)


# Author
Nico Hoffmann - <https://nhoffmann.com>
