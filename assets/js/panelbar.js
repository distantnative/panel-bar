
// Class handler functions

var hasClass = function (elem, className) {
  return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
};

var addClass = function (elem, className) {
  if (!hasClass(elem, className)) {
    elem.className += ' ' + className;
  }
};

var removeClass = function (elem, className) {
  var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, ' ') + ' ';
  if (hasClass(elem, className)) {
    while (newClass.indexOf(' ' + className + ' ') >= 0 ) {
      newClass = newClass.replace(' ' + className + ' ', ' ');
    }
    elem.className = newClass.replace(/^\s+|\s+$/g, '');
  }
};


// Elements
var wrapper   = document.getElementById('panelbar');
var panelbar  = document.getElementById('panelbar_bar');
var controls  = document.getElementById('panelbar_controls');
var switchbtn = document.getElementById('panelbar_switch');
var flipbtn   = document.getElementById('panelbar_flip');


if ('querySelector' in document && 'addEventListener' in window) {
  // Controls
  switchbtn.addEventListener('click', function () {
    if (hasClass(panelbar, 'panelbar__bar--hidden')) {
      removeClass(panelbar, 'panelbar__bar--hidden');
    } else {
      addClass(panelbar, 'panelbar__bar--hidden');
    }
  });
  flipbtn.addEventListener('click', function () {
    if (hasClass(wrapper, 'panelbar--top')) {
      removeClass(wrapper, 'panelbar--top');
    } else {
      addClass(wrapper, 'panelbar--top');
    }
    if (hasClass(wrapper, 'panelbar--bottom')) {
      removeClass(wrapper, 'panelbar--bottom');
    } else {
      addClass(wrapper, 'panelbar--bottom');
    }
  });

} else {
  // remove switch in legacy Browser
  controls.remove();
  panelbar.style.paddingRight = 0;
  panelbar.classList.remove("panelbar--hidden");
}
