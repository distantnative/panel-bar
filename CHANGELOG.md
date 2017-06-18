# Changelog

## [2.3.1](https://github.com/distantnative/panel-bar/releases/tag/2.3.1) (2017-05-18)
:zap: Improved handling of custom element plugins  
:globe_with_meridians: Panel view translatable  
:lock: Restricted API routes to users with panel access  
:alien: Improved panel instance imitation 
:bug: prevent reset of $site to home by panel instance imitation   
:truck: Moved files around  


## [2.3.0](https://github.com/distantnative/panel-bar/releases/tag/2.3.0) (2017-04-23)
:sparkles: Setting panel elements: panel view instead of widget  


## [2.2.1](https://github.com/distantnative/panel-bar/releases/tag/2.2.1) (2017-04-21)
:balloon: Do not display login shortcut as default (if you want it: `c::set('panelBar.login', true)`)  
:lipstick: Navigation element: Using blueprint page icons  
:bug: User element: display $user in translation  


## [2.2.0](https://github.com/distantnative/panel-bar/releases/tag/2.2.0) (2017-04-9)
:sparkles: New element: Google PageSpeed API
:sparkles: Set element float via panel widget
:lipstick: Panel widget: now all pretty
:balloon: Translations now follow the panel user's language  
:balloon: Translations now get passed {$variables} to be more flexible 
:poop: Dropped RTL support for the moment   

## [2.1.2](https://github.com/distantnative/panel-bar/releases/tag/2.1.2) (2017-03-28)
:bug: CLI installing to wrong destination  
:bug: active elements not considering default element set  

## [2.1.1](https://github.com/distantnative/panel-bar/releases/tag/2.1.1) (2017-03-26)
:bug: Visibility element: Unhiding numbered pages works again  
:bug: Modals: close button works again  

## [2.1.0](https://github.com/distantnative/panel-bar/releases/tag/2.1.0) (2017-03-26)
:rotating_light: Custom elements can only be created through element classes  
:sparkles: Panel widget to set the active panelBar elements  
:sparkles: Config file `site/config/panelBar.yml` defines element set  
:sparkles: Modal component to be used by elements  
:sparkles: Content component for easy pre-styled text  
:sparkles: New element: `navigation` (included in default set)  
:sparkles: Login icon when user is not signed-in  
:balloon: Dropdown pattern: additional CSS classes per dropdown item  
:balloon: Added `about` element as sample for modal and content component  
:balloon: Index element: using blueprint page icons  
:balloon: Panel integration: respect custom site paths  
:balloon: Set key shortcuts per element (`$this->key($keycode, $jsfunction)`)  
:bug: Handle element names with `-`(now stripping `-`)   
:bug: Core translations loading in time to be displayed   
:bug: Custom element classes would overwrite pattern classes  
:bug: Visibility element: Bug when hiding only child  
:bug: Overlay: border on iframe in Chrome  
:bug: Images element: responsive grid sizes  
:bug: Dropdowns disappeared in responsive mode  
:arrow_up: FontAwesome 4.7  
:books: MIT License added  
:books: Documentation offers more direct links to helpful code examples  

## [2.0.1](https://github.com/distantnative/panel-bar/releases/tag/2.0.1) (2017-03-24)
:bug: Custom element asset route fixed  

## [2.0.0](https://github.com/distantnative/panel-bar/releases/tag/2.0.0) (2017-03-24)
- Version 2 is here after years! :sparkle:
- Complete rewrite
- Feature: Encapsulated elements, custom element plugins and so much more
- Feature: Own registry for panelBar elements (so other plugins can provide their elements for the panelBar)
- Feature: Routes, Translations, Assets for elements
- Improved: Added methods to use localStorage for custom elements

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
