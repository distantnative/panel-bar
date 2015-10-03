
// @codekit-prepend "helpers/_classes.js";

var Panelbar = function() {

  var self = this;

  this.wrapper  = document.getElementById('panelbar');
  this.panelbar = document.getElementById('panelbar_bar');
  this.controls = document.getElementById('panelbar_controls');
  this.posBtn   = self.controls.children[0];
  this.visBtn   = self.controls.children[1];


  this.init = function() {
    if ('querySelector' in document && 'addEventListener' in window) {
      self.posBtn.addEventListener('click', self.switchPosition);
      self.visBtn.addEventListener('click', self.switchVisibility);

      if (panelbarKEYS === true) { self.keys(); }

    } else {
      self.controls.remove();
      self.panelbar.style.paddingRight = 0;
      self.panelbar.classList.remove("panelbar--hidden");
    }
  };


  this.switchPosition = function() {
    if (hasClass(self.wrapper, 'panelbar--top')) {
      removeClass(self.wrapper, 'panelbar--top');
      addClass(self.wrapper, 'panelbar--bottom');
    } else {
      addClass(self.wrapper, 'panelbar--top');
      removeClass(self.wrapper, 'panelbar--bottom');
    }
  };

  this.switchVisibility = function() {
    if (hasClass(self.panelbar, 'panelbar__bar--hidden')) {
      removeClass(self.panelbar, 'panelbar__bar--hidden');
    } else {
      addClass(self.panelbar, 'panelbar__bar--hidden');
    }
  };

  this.keys = function () {

  };

};

var panelbar = new Panelbar();
panelbar.init();
