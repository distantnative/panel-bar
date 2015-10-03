
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


  /**
   *  INIT
   */

  this.init = function() {
    if ('querySelector' in document && 'addEventListener' in window) {
      self.posBtn.addEventListener('click', self.switchPosition);
      self.visBtn.addEventListener('click', self.switchVisibility);

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
    removeClass(self.panelbar, 'panelbar__bar--hidden');
    self.visible = true;
  };

  this.hide = function() {
    addClass(self.panelbar, 'panelbar__bar--hidden');
    self.visible = false;
  };


  /**
   *  KEYBINDINGS
   */

  this.keys = function (e) {
    e = e || event;
    self.map[e.keyCode] = e.type == 'keydown';

    if(self.map[18] && self.map[88]) {            // alt + x
      self.switchVisibility();
    } else if(self.map[18] && self.map[189]) {    // alt + -
      self.switchPosition();
    } else if(self.map[18] && self.map[69]) {    // alt + E
      document.querySelector('.panelbar--edit a').click();
    } else if(self.map[18] && self.map[80]) {    // alt + P
      document.querySelector('.panelbar--panel a').click();
    }
  };

};


var panelbar = new Panelbar();
panelbar.init();
