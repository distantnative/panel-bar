# Changelog

## Version 0.5
- Changed parameter structure of `::show()` and `::hide()`:
```php
echo panelbar::show(array('elements' => $elements, 'css' => true, 'js' => true));
```
- Label, textbox and filewviewer element helpers added
- New Files and Images elements
- Better Add element (dropdown with child and sibling option)
- Limited set of default elements, while all are still available
- Option to hook custom CSS and/or JS in output functions
- Removed CDN requests for fonts in favor of local files
- Restructured PHP code (namespacing, split up into different classes)
- Started to clean up CSS and remove redundancies (SCSS introduced)
- Bugfix: Check correctly if jQuery is loaded

## Version 0.4
- Fewer jQuery dependencies
- Cleaner CSS and JS code and compression

## Version 0.3
- Added a button to flip the panel bar from top to bottom and vice versa
- Enhanced JS: toggle pages' visibility right from the panel bar (optional)
- Added "New Page" default element
- Visually more consistent with the panel
- Option to set what gets hidden on mobile views (more responsiveness in future releases)

## Version 0.2
- Improved element helpers
- Added a button to toggle visibility of panel bar
- Enhancements to clas code, CSS and JS
- Better protection of class methods not being used as elements
- Several bug fixes

## Version 0.1
- Initial version with elements for panel, page edits, visibility toggle, language switcher, user and logout
- Ready for custom elements
