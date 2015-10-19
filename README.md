![panelBar for Kirby CMS](http://distantnative.com/remote/github/kirby-panelbar.png)  

[![Release](https://img.shields.io/github/release/distantnative/panel-bar.svg)](https://github.com/distantnative/panel-bar/releases)  [![Issues](https://img.shields.io/github/issues/distantnative/panel-bar.svg)](https://github.com/distantnative/panel-bar/issues) [![License](https://img.shields.io/badge/license-GPLv3-blue.svg)](https://raw.githubusercontent.com/distantnative/panel-bar/master/LICENSE)
[![Moral License](https://img.shields.io/badge/buy-moral_license-8dae28.svg)](https://gumroad.com/l/kirby-panelbar)


This plugin enables you to include a panelBar on top of your site which gives you direct access to [some administrative functions](#StandardElements). The panelBar will only be visible to logged in users who are eligible to access the panel.

*Requires PHP 5.3+ and Kirby 2.1 or higher*


![panelBar - Files element](assets/screens/screen.png)  
![panelBar - Images element](assets/screens/screen2.png)  
![panelBar - Edit in iFrame view](assets/screens/screen3.png)  
![panelBar - Toggle element](assets/screens/screen4.png)
![panelBar - Add element](assets/screens/screen5.png)  


**Please support the development by buying a [moral license](https://gumroad.com/l/kirby-panelbar)!**

&nbsp;  

# Table of Contents
1. [Setup](#Setup)
2. [Usage](#Usage)
3. Elements
  1. [Standard Elements](#StandardElements)
  2. [Default Set of Elements](#DefaulSet)
4. Customize
  1. [Custom Set of Elements](#CustomSet)
  2. [Custom Elements](#CustomElements)
  3. [Element Builders](#Builders)
  4. [Custom CSS/JS](#CustomCSSJS)
  5. [Hooks](#Hooks)
  6. [Output CSS/JS](#OutputCSSJS)
  7. [Assets Guide](assets/GUIDE.md)
5. Options
  1. [Default Position](#OptionPosition)
  2. [Responsiveness](#OptionResponsive)
  3. [Remember State](#OptionState)
  4. [Enhanced JS](#OptionEnhancedJS)
  5. [Keyboard Shortcuts](#OptionKeyboard)
6. [Known Problems](#Problems)
7. [Help & Improve](#Help)
8. [Changelog](CHANGELOG.md)

&nbsp;  

# Setup<a id="Setup"></a>
1. Download the [panelBar plugin](https://github.com/distantnative/panel-bar/zipball/master/)
2. Copy the whole folder to `site/plugins/panel-bar`

&nbsp;  

# Usage <a id="Usage"></a>
Include in your `site/snippets/footer.php` (or equivalent) before the `</body>` tag:
```php
<?php echo panelBar::show() ?>
```

If you want the panelBar hidden when the page loads:
```php
<?php echo panelBar::hide() ?>
```

If you want to use **caching with Kirby**, please make sure to only activate it if the visitor is not a logged-in user:
```php
if(!site()->user()) c::set('cache', true);
```

&nbsp;  

# Elements

### Standard Elements <a id="StandardElements"></a>
The panelBar provides several standard elements:  

Name        | Description
----------- | ---------------------------------------------------------
`panel`     | Open the Kirby panel
`index`     | List of all pages (index)
`add`       | Add page as sibling or child
`edit`      | Edit current page
`toggle`    | Change the visibility of the current page (hide/publish)
`files`     | List of files of the current page
`fileview`  | Viewer for files of the current page
`images`    | Viewer for images of the current page
`imagelist` | List of images of the current page
`loadtime`  | Info label for loading time
`language`  | Dropdown to switch between site languages
`user`      | Current user
`logout`    | Sign out current user


### Default Set of Elements <a id="DefaultSet"></a>
The pre-defined default set of elements consists of `panel`, `add`, `edit`, `toggle`, `files`, `user` and `logout`. You can define your own [custom set of elements](#CustomSet).

&nbsp;  

# Customize

### Custom Set of Elements <a id="CustomSet"></a>
You can define a custom set of elements in `site/config/config.php`:
```php
c::set('panelbar.elements', array(…));
```

Or pass them as a parameter when calling `::show()` or `::hide()`:
```php
<?php echo panelBar::show(array('elements' => array(…))) ?>
```

To include [standard elements](#StandardElements) in your custom set, simply name them:
```php
c::set('panelbar.elements', array(
  'panel', 
  'edit', 
  'languages',
));
```

Or you can add your custom set of elements to the [default set of elements](#DefaultSet) using `::defaults()` which returns either just the default set or merges it with any array of elements if provided as a parameter:
```php
<?php
$elements = panelBar::defaults(array(
  'customDropdown',
  'custom2'
));

echo panelBar::show(array('elements' => $elements));
?>
```


### Custom Elements <a id="CustomElements"></a>
The panelBar can include custom elements. You can either include the custom element's output code directly in the elements array or use the name of a callable function in the array, which returns the output code:
```php
<?php
// custom callable element
function customSongs() {
  return '<div class="panelbar-element panelbar-drop"><span><i class="fa fa-headphones "></i><span>Songs</span></span><div class="panelbar-drop__list"><a href="https://www.youtube.com/watch?v=BIp_Y28qyZc" class="panelbar-drop__item">Como Soy</a><a href="https://www.youtube.com/watch?v=gdby5w5rseo" class="panelbar-drop__item">Me Gusta</a></div></div>';
}

// array of elements
$elements = array(
  'panel',
  'add',
  'edit',
  '<div class="panelbar-element panelbar-btn"><a href="http://mydomain.com/pictureofmum.jpg"><i class="fa fa-heart "></i><span>Mum</span></a></div>',
  'customSongs',
);

// output panelBar
echo panelBar::show(array('elements' => $elements));
?>
```

For more complex custom elements, have a look at panelBar's [assets guide](assets/GUIDE.md) on its core CSS and Javascript elements.

### Element Builders <a id="Builders"></a>
The panelBar plugin includes four builder method, which can be used to create custom elements. All builders require some basic parameters:
```php
panelBar::builder(array(
  'id'      => 'theID',             // unique identifier
  'icon'    => 'heart',             // FontAwesome icon (without fa-)
  'label'   => 'Just the label',    // text used as label
  'mobile'  => 'label',             // what's showed in mobile view (default: icon)
  'compact' => false                // show it in compact view (default: false)
));
```

The following element builders are available and require additional parameters if referenced:  

1. **Label**  

    ```php
    panelBar::label(array(
      …,
    ));
    ```

2. **Link**  

    ```php
    panelBar::link(array(
      …,
      'url' => site()->url().'/panel',  // URL to which the button links
    ));
    ```

3. **Dropdown**  

    ```php
    panelBar::dropdown(array(
      …,
      'items' => array(     // array of dropdown elements
        0 => array(
          'label' => …,     // label of the dropdown element
          'url'   => …,     // URL to which dropdown element links
        ),
        …
       ),
    ));
    ```

4. **Textbox**  

    ```php
    panelBar::box(array(
      …,
      'content' => '<b>Important information</b>', // (HTML) content of the textbox
    ));
    ```
&nbsp;

With the builders you can easily create [custom elements](#CustomElements) and add them to your [custom set of elements](#CustomSet) - for example:
```php
<?php
// custom callable element using the dropdown builder
function customDropdown() {
  return panelBar::dropdown(array(
    'id'    => 'songs',
    'icon'  => 'headphones',
    'label' => 'Songs',
    'items' => array(
      array(
        'url'   => 'https://www.youtube.com/watch?v=BIp_Y28qyZc',
        'label' => 'Como Soy',
      ),
      array(
        'url'   => 'https://www.youtube.com/watch?v=gdby5w5rseo',
        'label' => 'Me Gusta',
      ),
     )
  ));
}

// array of elements
$elements = array(
  'panel',
  panelBar::link(array(
    'id'    => 'mum',
    'icon'  => 'heart',
    'label' => 'Mum',
    'url'   => 'http://mydomain.com/pictureofmum.jpg',
  )),
  'customDropdown',
);

// output panelBar
echo panelBar::show(array('elements' => $elements));
?>
```


*If you use any builders in the `config.php`, you must prepend the following line:*  
```php
kirby()->plugin('panel-bar');
```


### Custom CSS/JS <a id="CustomCSSJS"></a>
To include your custom CSS and JS with panelBar (e.g. for a [custom element](#CustomElement)), the best way would be to use [asset hooks](#Hooks) in your custom element function. However, you can also pass custom CSS and JS as parameters to the `::show()` and `::hide()` methods:
```php
<?php echo panelBar::show(array('css' => '.mylove{}', 'js' => 'console.log("hello");')) ?>
```


### Hooks for Assets/Output <a id="Hooks"></a>
There are two types of hooks in panelBar: asset hooks and output hooks. Asset hooks are divided into `css` and `js`. Output hooks all refer to HTML but are included at different positions in the panel bar: as `element`, `before` and `after`. To make use of assets and output hooks, the plugin passes the `$output` and `$assets` objects to callable custom element functions:
```php
<?php
// custom callable element using assets and output hooks
function customHelpElement($output, $assets) {
  $assets->setHook('css',      '.mylove{}');
  $assets->setHook('js',       'console.log("hello");');
  $output->setHook('elements', panelBar::label(…));
}

// array of elements
$elements = array(
  'panel',
  'customHelpElement',
);

// output panelBar
echo panelBar::show(array('elements' => $elements));
?>
```

If you do not want to directly set hooks, you can return an array instead and the plugin will take care of hooking the CSS, JS and/or HTML into the panelBar:
```php
// custom callable elements returning array to register hooks
function customHelpElement() {
  return array(
    'element' => '…',
    'assets'  => array(
      'css' => '.mylove{}',
      'js'  => 'console.log("hello");',
    ),
    'html'    => array(
      'before' => '…',
      'after'  => '…',
    )
  );
}

// array of elements
$elements = array(
  'panel',
  'customHelpElement',
);

// output panelBar
echo panelBar::show(array('elements' => $elements));
```


### Output CSS/JS separately <a id="OutputCSSJS"></a>
At default, panelBar includes the necessary CSS styles and JS scripts in its output. If you not want to output the CSS and/or JS directly with the panelBar (e.g. separately within the `<head>` section), you first have to disable their output:
```php
<?php echo panelBar::show(array('css' => false, 'js' => false) ?>
```

To output the CSS and/or JS wherever you want it, just use `::css()` or `::js()`:
```php
<?php echo panelBar::js() ?>
```

If you use a [custom set of elements](#CustomSet), please make sure to also pass the array of elements:
```php
<?php echo panelBar::js(array('elements' => $elements)) ?>
```

You can also still pass your [custom CSS/JS](#CustomCSSJS) to these methods:  
```php
<?php echo panelBar::css(array('elements' => $elements, 'css' => '.mylove{}') ?>
```

&nbsp;  

# Options
All options refer to settings in the `site/config/config.php` if not stated otherwise.

### Default Position <a id="OptionPosition"></a>
To change the default position of the panelBar to bottom include:
```php
c::set('panelbar.position', 'bottom');
```


### Responsivesness <a id="OptionResponsive"></a>
To deactivate the javascript that makes the panelBar responsive to mobile devices include:
```php
c::set('panelbar.responsive', false);
```


### Remember State <a id="OptionState"></a>
The panelBar will be loaded on default at the [defined positon](#OptionPosition) and visible whether you included it in your templates with `::show()` or `::hide()`. But it also tries to remember its state across page loads (e.g. it loads on top, you move it to bottom and you want it to be still on bottom after clicking on a link) via your browser's local storage. If you want to disable this, you need to include:
```php
c::set('panelbar.remember', false);
```


### Enhanced Javascript <a id="OptionEnhancedJS"></a>
By default, the panelBar comes with some javascript functionalities (e.g. loading the edit mode in an iFrame). If you want to disable these functionalities and just use the panelBar elements as plain links, you need to include:
```php
c::set('panelbar.enhancedJS', false);
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

If you want to deactivate these keyboard shortcuts, you have to include:
```php
c::set('panelbar.keys', false);
```

&nbsp;  

# Known Problems <a id="Problems"></a>
**X-Frame-Options**  
If you have set the `X-Frame-Options` in your `.htaccess` to `DENY`, panelBar will not be able to display the panel in its embedded iFrame mode. panelBar tries to detect this barrier and then switch to plain links.

&nbsp;  

# Help & Improve <a id="Help"></a>
If you find any bugs, have troubles or ideas for new elements or further configuration options, please let me know [by opening a new issue](https://github.com/distantnative/panel-bar/issues/new).

So far the plugin has been free of charge and open for everyone to use it. Still, if it helps you with your work and/or life and you can share, I would really appreciate your support by buying a [moral license](https://gumroad.com/l/kirby-panelbar).
