# Guide to panelBar assets

## (S)CSS
All of panelBar's CSS is pre-processed from several [SCSS](http://sass-lang.com) files (you can find them in `assets/scss/` and the processed CSS files in `assets/css/`). Moreover, panelBar's CSS is split up in several files to only load the CSS necessary for the active [set of elements](../README.md#CustomSet) and functions.

The following class and selected modifier classes are added to the main panelBar wrapper:
```css
.panelBar           { }
.panelBar--top      { }
.panelBar--bottom   { }
.panelBar--hidden   { }
```

The following classes and class modifiers refer to the wrapper for all panelBar elements as well as each panelBar element and their unqiue identifier class:
```css
.panelBar__bar    { }

.panelBar-element        { }
.panelBar-element--right { }

.panelBar--#{ELEMENTID}  { }
```

The following classes refer to the control buttons wrapper and each control button group:
```css
.panelBar-controls              { }
.panelBar-controls__position    { }
.panelBar-controls__visibility  { }
```


&nbsp;

## Javascript

### panelBar (class panelBarObj)
The `var panelBar` includes the main instance of the `panelBarObj` class, which includes all core JS functionalities of panelBar and can be used to help you with your custom element.

Selected properties which might be useful for you:
```javascript
panelBar.wrapper    // outer wrapper div
panelBar.bar        // inner wrapper div for all elements
panelBar.controls   // wrapper div for position and visibility buttons
panelBar.posBtn     // position buttons div
panelBar.visBtn     // visibility buttons div
panelBar.visible    // current visibility status (true/false)
panelBar.position   // current position ('top'/'bottom')
```

Selected methods which might be useful for you:
```javascript
panelBar.switchPosition()     // toggles position
panelBar.top()                // sets position to top
panelBar.bottom()             // sets position to bottom
panelBar.switchVisibility()   // toggles visibility
panelBar.show()               // shows panelBar
panelBar.hide()               // hides panelBar
```

Options:  
- [Keyboard Shortcuts](../README.md#OptionKeyboard)


### pbResponsive (class panelBarResponsive)
The `var pbResponsive` includes the main instance of the `panelBarResponsive` class, which is used for mobile responsiveness if not [switched off](../README.md#OptionResponsive).


### pbState (class panelBarState)
The `var pbState` includes the main instance of the `panelBarState` class, which is used to store the current state of panelBar's position and visibility across page loads - if not [switched off](../README.md#OptionState).


### pbIframe (class panelBarIframe)
The `var pbIframe` includes the main instance of the `panelBarIframe` class, which is used for all elements that feature the iFrame mode (link click opens panel in an iFrame).

Selected properties which might be useful for you:
```javascript
pbIframe.active       // status if iFrame mode is activated (true/false)
pbIframe.supported    // status if iFrame mode is supported (true/false)
pbIframe.wrapper      // wrapper for iFrame elements (laoding + iframe)
pbIframe.iframe       // actual iframe element
pbIframe.loading      // loading screen element
pbIframe.buttons      // iFrame mode return buttons
pbIframe.returnBtn    // 'Return to Page' button
pbIframe.refreshBtn   // 'Return and Refresh' button
```

Selected methods which might be useful for you:
```javascript
pbIframe.add(link)      // adds iFrame mode functionality to a link
pbIframe.show(url)      // activates iFrame mode (deactivate with empty url)
pbIframe.load(url)      // loads url in iFrame mode
```

### pbToggle (class panelBarToggle)
The `var pbToggle` includes the main instance of the `panelBarToggle` class, which is used for AJAX functionality of the toggle standard element.
