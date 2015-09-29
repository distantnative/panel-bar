![Panel Bar for Kirby CMS](http://distantnative.com/remote/github/kirby-panelbar.png)  

[![Release](https://img.shields.io/github/release/distantnative/panel-bar.svg)](https://github.com/distantnative/panel-bar/releases)  [![Issues](https://img.shields.io/github/issues/distantnative/panel-bar.svg)](https://github.com/distantnative/panel-bar/issues) [![License](https://img.shields.io/badge/license-GPLv3-blue.svg)](https://raw.githubusercontent.com/distantnative/panel-bar/master/LICENSE)
[![Moral License](https://img.shields.io/badge/buy-moral_license-8dae28.svg)](https://gumroad.com/l/kirby-panelbar)


This plugin enables you to include a panel bar on top of your site which gives you direct access to some administrative functions. The panel bar will only be visible to logged in users who are eligible to access the panel.

![Panel Bar in action](screen.png)

**The plugin is free. However, I would really appreciate if you could support me with a [moral license](https://gumroad.com/l/kirby-panelbar)!**


# Table of Contents
1. [Installation & Update](#Installation)
2. [Usage](#Usage)
3. [Options](#Options)
4. [Addons](#Addons)
5. [Help & Improve](#Help)
6. [Version History](#VersionHistory)



# Installation & Update <a id="Installation"></a>
1. Download [Panel Bar](https://github.com/distantnative/panel-bar/zipball/master/)
2. Copy the whole folder to `site/plugins/panel-bar`



# Usage <a id="Usage"></a>
Include in your `site/snippets/footer.php` right before the `</body>` tag:
```php
<?php echo panelbar::show() ?>
```

Or with the following if you want the panel bar hidden on load:
```php
<?php echo panelbar::hide() ?>
```

You can toggle the visibility of the panel bar on the right side, if your browser supports Javascript. If not, panel bar will simply hide the toggle switch and display the panel bar always.

**Caching**
If you want to use caching with Kirby, please make sure to only activate it if the visitor is not a logged-in user (in `site/config/config.php`):
```php
if(!site()->user()) c::set('cache', true);
```



# Options <a id="Options"></a>

## Choose elements and/or add custom elements

Panel Bar comes with a pre-defined set of default elements: `panel`, `add`, `edit`, `files`, `user` and `logout`. However, there are more standard elements available, which come already included in the Panel Bar plugin. A full list of all included standard elements:
- `panel` (link to the panel)
- `add` (pages as sibling or child)
- `edit` (current page)
- `toggle` (visibility toggle to hide/publish the page)
- `files` (viewer for files of the current page)
- `images` (viewer for image of the current page)
- `loadtime` (loading time)
- `languages` (dropdown to switch between site languages)
- `user`
- `logout`

### Define custom set of elements
To define which elements should be included in the panel bar, you can either set a config option (in `site/config/config.php`):

```php
c::set('panelbar.elements', array(…));
```

Or pass them as an argument when displaying the panel bar:

```php
<?php echo panelbar::show(array('elements' => array(…))) ?>
```

### Use standard elements 

You can include standard elements either by naming them:

```php
c::set('panelbar.elements', array(
  'panel', 
  'edit', 
  'toggle', 
  'languages', 
  'logout', 
  'user'
));
```

Or you can merge your custom array with the default set of elements:

```php
c::set('panelbar.elements', a::merge(array(
  'custom1',
  'custom 2'
), panelbar::defaults()));
```


### Add custom elements 

Panel Bar also is prepared to include custom elements. For custom elements you can either pass the HTML directly in the array or use the name of a callable function in the array which then returns the HTML code.

Moreover, there are four helpers available to create elements:

**Label elements**
```php
panelbar::label(array(
  'id'     => 'loadtime',
  'icon'   => 'clock-o',
  'label'  => number_format( ( microtime( true ) - $_SERVER['REQUEST_TIME_FLOAT'] ), 2 ),
  'mobile' => 'label',
));
```

**Link elements**
```php
panelbar::link(array(
  'id'     => 'panel',
  'icon'   => 'cogs',
  'url'    => site()->url().'/panel',
  'label'  => 'Panel'
  'mobile' => 'icon',
));
```

**Dropdown elements**
```php
panelbar::dropdown(array(
  'id'    => 'lang',
  'icon'  => 'flag',
  'label' => 'Language',
  'items' => array(
               0 => array(
                     'url'   => …,
                     'label' => …
                    ),
               1 => array(
                     'url'   => …,
                     'label' => …
                    ),
               …
             ),
  'mobile' => 'label',
));
```

**Textbox elements**
```php
panelbar::box(array(
  'id'      => 'info',
  'icon'    => 'info',
  'content' => '<b>Important information</b>',
  'label'   => 'Info'
  'mobile'  => 'icon',
));
```

### Examples
```php
c::set('panelbar.elements', array(
  'panel', 
  'edit',
  'custom-link' => panelbar::link(array(
                    'id'   => 'mum',
                    'icon' => 'heart',
                    'url'  => 'http://mydomain.com/pictureofmum.jpg',
                    'text' => 'Mum'
                  )),
  'custom-dropdown' => 'dropitpanelbar',
  'logout', 
));

function dropitpanelbar() {
  return panelbar::dropdown(array(
    'id'    => 'songs',
    'icon'  => 'headphones',
    'label' => 'Songs',
    'items' => array(
                 0 => array(
                       'url' => 'https://www.youtube.com/watch?v=BIp_Y28qyZc',
                       'text' => 'Como Soy'
                      ),
                 1 => array(
                       'url' => 'https://www.youtube.com/watch?v=gdby5w5rseo',
                       'text' => 'Me Gusta'
                      ),
               )
  ));
}
```

*If you use any helpers like `panelbar::link()`, `panelbar::dropdown()` or `panelbar::defaults()` in the `config.php`, you must include the following line before using them:*

```php
kirby()->plugin('panel-bar');
```


## Position of Panel Bar
You can switch the position of the panel bar from the top to the bottom browser window border (in your `site/config/config.php`):

```php
c::set('panelbar.position', 'bottom');
```


## Output CSS / JS separately
If you want to output the CSS and/or JS not with the panel bar, but separately e.g. in the `<head>` section,:

```php
<?php echo panelbar::show(array('css' => false, 'js' => false) ?>
```

Then you can add the following code where you want to output the CSS/JS:

```php
<?php echo panelbar::css() ?>
<?php echo panelbar::js() ?>
```




# Help & Improve <a id="Help"></a>
*If you have any suggestions for new elements or further configuration options, [please let me know](https://github.com/distantnative/panel-bar/issues/new).*




# Version history <a id="VersionHistory"></a>
Check out the more or less complete [changelog](https://github.com/distantnative/panel-bar/blob/master/CHANGELOG.md).
