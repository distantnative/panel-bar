
// @codekit-prepend "helpers/_classes.js";

var panelBarObj = function() {

  var self = this;

  this.wrapper  = document.getElementById('panelBar');
  this.bar      = document.getElementById('panelBar_bar');
  this.controls = document.getElementById('panelBar_controls');
  this.posBtn   = this.controls.children[0];
  this.visBtn   = this.controls.children[1];
  this.visible  = !hasClass(this.bar, 'panelBar__bar--hidden');
  this.position = hasClass(this.wrapper, 'panelBar--top') ? 'top' : 'bottom';
  this.map      = [];



  /**
   *  INIT
   */

  this.init = function() {
    if ('querySelector' in document && 'addEventListener' in window) {
      self.posBtn.addEventListener('click', self.switchPosition);
      self.visBtn.addEventListener('click', self.switchVisibility);

      if (panelBarKEYS === true) {
        document.addEventListener('keydown', self.keys);
        document.addEventListener('keyup',   self.keys);
      }

    } else {
      self.controls.remove();
      self.bar.style.paddingRight = 0;
      self.bar.classList.remove("panelBar--hidden");
    }
  };


  /**
   *  POSITION
   */

  this.switchPosition = function() {
    if (self.position === 'top') {
      self.bottom();
    } else {
      self.top();
    }
  };

  this.top = function() {
    removeClass(self.wrapper, 'panelBar--bottom');
    addClass(self.wrapper, 'panelBar--top');
    self.position = 'top';
  };

  this.bottom = function() {
    removeClass(self.wrapper, 'panelBar--top');
    addClass(self.wrapper, 'panelBar--bottom');
    self.position = 'bottom';
  };


  /**
   *  VISIBILITY
   */

  this.switchVisibility = function() {
    if (self.visible) {
      self.hide();
    } else {
      self.show();
    }
  };

  this.show = function() {
    removeClass(self.wrapper, 'panelBar--hidden');
    self.visible = true;
  };

  this.hide = function() {
    addClass(self.wrapper, 'panelBar--hidden');
    self.visible = false;
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

    } else if(self.map[18] && self.map[80]) {                 // alt + P
      self.map      = [];
      location.href = self.bar.querySelector('.panelBar--panel a').href;

    } else if(self.map[18] && self.map[77]) {                 // alt + M
      if(typeof pbIframe !== 'undefined' && pbIframe.active === false) {
        self.bar.querySelector('.panelBar--edit a').click();
      }
    }
  };

  this.init();
};


var panelBar = new panelBarObj();
