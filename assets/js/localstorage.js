
var PanelbarState = function() {
  var self = this;

  this.controls  = document.getElementById("panelbar_controls");
  this.validTime = 24 * 60 * 60 * 1000;


  self.init = function() {
    if(self.support()) {

      if(self.expired()) {
        self.reset();
      } else {
        self.restore();
      }

      self.save();
      self.controls.addEventListener('click', self.save);

    } else {
      console.log('PanelBar: localStorage not supported');
    }
  };


  this.save = function() {
    localStorage['panelbar.expires']    = Date.now() + self.validTime;
    localStorage['panelbar.position']   = self.getPosition();
    localStorage['panelbar.visibility'] = self.getVisibility();
  };


  this.restore = function() {
    self.setPosition();
    self.setVisibility();
  };


  this.reset = function() {
    localStorage.removeItem("panelbar.expires");
    localStorage.removeItem("panelbar.position");
    localStorage.removeItem("panelbar.visibility");
  };


  this.getPosition = function() {
    if (hasClass(wrapper, 'panelbar--top')) {
      return 'top';
    } else {
      return 'bottom';
    }
  };

  this.setPosition = function() {
    var position = localStorage['panelbar.position'];
    removeClass(wrapper, 'panelbar--' + (position === 'top' ? 'bottom' : 'top'));
    addClass(wrapper, 'panelbar--' + position);
  };

  this.getVisibility = function() {
    if (hasClass(panelbar, 'panelbar__bar--hidden')) {
      return 'hide';
    } else {
      return 'show';
    }
  };

  this.setVisibility = function() {
    if (localStorage['panelbar.visibility'] === 'show') {
      removeClass(panelbar, 'panelbar__bar--hidden');
    } else {
      addClass(panelbar, 'panelbar__bar--hidden');
    }
  };


  this.expired = function() {
    return Date.now() > localStorage['panelbar.expires'];
  };


  this.support = function() {
    try {
      return window.localStorage && window.localStorage !== null;
    } catch (e) {
      return false;
    }
  };

};


var pbState = new PanelbarState();
pbState.init();
