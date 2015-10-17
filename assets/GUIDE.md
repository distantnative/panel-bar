# Guide to panelBar assets

## (S)CSS
All of panelBar's CSS is pre-processed from several [SCSS](http://sass-lang.com) files (you can find them in `assets/scss/` and the processed CSS files in `assets/css/`). Moreover, panelBar's CSS is split up in several files to only load the CSS necessary for the active [set of elements](../README.md#CustomSet) and functions.

```css
.panelBar           { }
.panelBar--top      { }
.panelBar--bottom   { }
.panelBar--hidden   { }
```

```css
.panelBar__bar    { }

.panelBar-element        { }
.panelBar-element--right { }

.panelBar--#{ELEMENTID}  { }
```

```css
.panelBar-controls              { }
.panelBar-controls__position    { }
.panelBar-controls__visibility  { }
```

&nbsp;

## Javascript

### panelBar (class panelBarObj)
Selected properties which might be useful for you:
```javascript
panelBar.wrapper    // outer wrapper
panelBar.bar        // inner wrapper for all elements
panelBar.controls   // wrapper for position and visibility buttons
panelBar.posBtn     // position button
panelBar.visBtn     // visibility button
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

Options:  
- [Responsiveness](../README.md#OptionResponsive)


### pbState (class panelBarState)

Options:  
- [localStorage](../README.md#OptionState)


### pbIframe (class panelBarIframe)

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
