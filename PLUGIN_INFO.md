This plugin enables you to include a panel bar on top of your site which gives you direct access to some administrative functions. The panel bar will only be visible to logged in users who are eligible to access the panel.

![Panel Bar in action](https://github.com/distantnative/panel-bar/blob/master/assets/screens/screen.png)



# Setup<a id="Setup"></a>
1. Download the [panel-bar plugin](https://github.com/distantnative/panel-bar/zipball/master/)
2. Copy the whole folder to `site/plugins/panel-bar`



# Usage
Include in your `site/snippets/footer.php` (or equivalent) before the `</body>` tag:
```php
<?php echo panelbar::show() ?>
```


# Documentation

You can find the full documentation of all options and how to customize the panel bar over at the [Github repository](http://www.github.com/distantnative/panel-bar).
