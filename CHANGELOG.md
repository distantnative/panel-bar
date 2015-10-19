# Changelog

## Version 1.0
- Feature: Close button in iFrame mode which redirects to current panel page
- Feature: Added a first draft of the [assets guide](assets/GUIDE.md)
- Improved: iFrame mode detects `X-Frame-Options = DENY` and deativates
- Improved: Filelist is now Files, sorted files
- Improved: File icons in Files
- Improved: Panel, Files and Imagelist elements also open in iFrame mode
- Improved: Only load right-to-left styles if RTL language active
- Improved: Code clean-up and removed redundancies
- Fixed: Using `::defaults()`
- Fixed: `tools::url` for certain objects
- Fixed: Images layout and margins
- Fixed: Images background on hover
- Internal: Changed consitent naming to panelBar
- Internal: Renamed toolkit `pb::` to `tools::`, redundant namespace references removed

## Version 0.7
- Feature: Added Filelist and Imagelist standard element 
- Feature: Added Index standard element
- Feature: Added Toggle element to default set of elements
- Feature: Scrollable drop elements (dropdown, textbox, fileviewer etc.)
- Feature: Lots of improvements for fileviewers (Files and Images standard element)
- Feature: Added RTL language support ([set up](http://getkirby.com/docs/languages/supporting-RTL-languages) in your theme)
- Feature: `panelbar.enhancedJS` option to disable element js (default: true)
- Feature: Better control over responsive display
- Improved: Mobile responsiveness (as own JS object)
- Fixed: `panelbar.remember` option works now (+ default: true)
- Fixed `::css()` and `::js()` with custom set of elements
- Fixed: Panel Keyboard Shortcut (Alt + P)
- Fixed: Lots of small styling fixes
- Internal: Cleaner, better-readable CSS, JS and PHP code

## Version 0.6
- Feature: Added iFrame mode for most elements (e.g. Add, Edit, Files, User)
- Feature: Added persistent state of position and visibility (localStorage)
- Feature: Added AJAX-ified Toggle element (for Kirby versions < 2.2.0)
- Feature: Added keyboard shortcuts
- Feature: Added assets and output hooks (usable in callable custom element)
- Improved: Split up assets and only including required ones (reduces inserted code)
- Improved: Completely jQuery independent
- Improved: Prepared panel urls for Kirby 2.2.0
- Improved: Added some title tags
- Improved: Design improvements on several elements
- Improved: Extended and updated docs + more screenshots
- Fixed: Added IDs to elements created by element builders
- Fixed: Increased z-index (CSS)
- Fixed: Missing border on unfloated last element
- Internal: Standard elements and builders use assets and output hooks
- Internal: Added `pb::` toolkit
- Internal: Refactored JS as objects
- Internal: Refactored a lot of the PHP code to get a much cleaner structure
- Internal: Restructured a lot of the plugin files (new: template files)
- Internal: Simplified paths to plugin files and panel fonts
- Internal: Better protection of plugin methods as callable elements
- Internal: Renamed `helpers::` to `build::`

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
