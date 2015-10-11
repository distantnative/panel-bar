
// @codekit-prepend "helpers/_classes.js";

var Panelbar = function() {

  var self = this;

  this.wrapper  = document.getElementById('panelbar');
  this.panelbar = document.getElementById('panelbar_bar');
  this.controls = document.getElementById('panelbar_controls');
  this.posBtn   = this.controls.children[0];
  this.visBtn   = this.controls.children[1];
  this.visible  = !hasClass(this.panelbar, 'panelbar__bar--hidden');
  this.position = hasClass(this.wrapper, 'panelbar--top') ? 'top' : 'bottom';
  this.map      = [];
  this.resize   = null;
  this.mobile   = null;
  this.desktop  = null;


  /**
   *  INIT
   */

  this.init = function() {
    if ('querySelector' in document && 'addEventListener' in window) {
      self.posBtn.addEventListener('click', self.switchPosition);
      self.visBtn.addEventListener('click', self.switchVisibility);
      self.responsive();

      if (panelbarKEYS === true) {
        document.addEventListener('keydown', self.keys);
        document.addEventListener('keyup',   self.keys);
      }

    } else {
      self.controls.remove();
      self.panelbar.style.paddingRight = 0;
      self.panelbar.classList.remove("panelbar--hidden");
    }
  };


  /**
   *  POSITION
   */

  this.switchPosition = function() {
    if (self.position === 'top') { self.bottom(); }
    else                         { self.top();    }
  };

  this.top = function() {
    removeClass(self.wrapper, 'panelbar--bottom');
    addClass(self.wrapper, 'panelbar--top');
    self.position = 'top';
  };

  this.bottom = function() {
    removeClass(self.wrapper, 'panelbar--top');
    addClass(self.wrapper, 'panelbar--bottom');

    self.position = 'bottom';
  };


  /**
   *  VISIBILITY
   */

  this.switchVisibility = function() {
    if (self.visible) { self.hide(); }
    else              { self.show(); }
  };

  this.show = function() {
    removeClass(self.wrapper, 'panelbar--hidden');
    self.visible = true;
  };

  this.hide = function() {
    addClass(self.wrapper, 'panelbar--hidden');
    self.visible = false;
  };

  /**
   *  RESPONSIVENESS
   */

  this.responsive = function() {
    setTimeout(self.setupResponsive, 100);
    setTimeout(self.setupResponsive, 250);
    window.addEventListener('resize', self.onResize);
  };

  this.setupResponsive = function() {
    self.measureResponsive();
    self.adaptResponsive();
  };

  this.onResize = function() {
    self.panelbar.style.overflowY = 'hidden';
    clearTimeout(self.resize);
    self.resize = setTimeout(function() {
      self.adaptResponsive();
      self.panelbar.style.overflowY = 'visible';
    }, 50);
  };

  this.measureResponsive = function() {
    removeClass(self.wrapper, 'panelbar--compact');
    addClass(self.wrapper, 'panelbar--mobile');
    self.mobile  = self.widthResponsive();
    removeClass(self.wrapper, 'panelbar--mobile');
    self.desktop = self.widthResponsive();
  };

  this.adaptResponsive = function() {
    if(self.wrapper.offsetWidth < self.mobile) {
      addClass(self.wrapper, 'panelbar--compact');
      addClass(self.wrapper, 'panelbar--mobile');
    } else if(self.wrapper.offsetWidth < self.desktop) {
      removeClass(self.wrapper, 'panelbar--compact');
      addClass(self.wrapper, 'panelbar--mobile');
    } else {
      removeClass(self.wrapper, 'panelbar--compact');
      removeClass(self.wrapper, 'panelbar--mobile');
    }
  };

  this.widthResponsive = function() {
    var width    = self.controls.offsetWidth + 40;
    var elements = self.panelbar.children;
    var i;
    for (i = 0; i < elements.length; i++) {
      width = width + elements[i].offsetWidth;
    }
    return width;
  };

  /**
   *  KEYBINDINGS
   */

  this.keys = function(e) {
    e = e || event;
    self.map[e.keyCode] = e.type === 'keydown';

    if(self.map[18] && self.map[88]) {                        // alt + x
      self.switchVisibility();
    } else if(self.map[18] && self.map[189]) {                // alt + -
      self.switchPosition();
    } else if(self.map[18] && self.map[38]) {                 // alt + up
      self.top();
    } else if(self.map[18] && self.map[40]) {                 // alt + down
      self.bottom();
    } else if(self.map[18] && self.map[69]) {                 // alt + E
      if(panelbarIframe.active === false) {
        document.querySelector('.panelbar--edit a').click();
      } else {
        document.querySelector('.js_panelbar-iframe-close').click();
      }
    } else if(self.map[18] && self.map[82]) {                 // alt + R
      if(panelbarIframe.active === true) {
        document.querySelector('.js_panelbar-iframe-closerefresh').click();
      }
    } else if(self.map[18] && self.map[80]) {                 // alt + P
      location.href = document.querySelector('.panelbar--panel a').href;
    }
  };

};


var panelbar = new Panelbar();
panelbar.init();
