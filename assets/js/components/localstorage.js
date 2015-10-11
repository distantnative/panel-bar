
var PanelbarState = function() {

  var self = this;

  this.validTime = 24 * 60 * 60 * 1000;

  self.init = function() {
    if(self.support()) {
      if(self.expired()) {
        self.reset();
      } else {
        self.restore();
      }
      self.save();
      panelbar.controls.addEventListener('click', self.save);
    }
  };

  this.save = function() {
    localStorage.setItem('panelbar.expires',  Date.now() + self.validTime);
    localStorage.setItem('panelbar.position', panelbar.position);
    localStorage.setItem('panelbar.visible',  panelbar.visible);
  };

  this.restore = function() {
    self.setPosition();
    self.setVisibility();
  };

  this.reset = function() {
    localStorage.removeItem('panelbar.expires');
    localStorage.removeItem('panelbar.position');
    localStorage.removeItem('panelbar.visibile');
  };

  this.setPosition = function() {
    if(localStorage.getItem('panelbar.position') === 'top') {
      panelbar.top();
    } else {
      panelbar.bottom();
    }
  };

  this.setVisibility = function() {
    if(localStorage.getItem('panelbar.visible') === 'true') {
      panelbar.show();
    } else {
      panelbar.hide();
    }
  };


  this.expired = function() {
    return Date.now() > localStorage.getItem('panelbar.expires');
  };


  this.support = function() {
    try {
      var x = '__storage_test__';
      localStorage.setItem(x, x);
      localStorage.getItem(x);
      localStorage.removeItem(x);
      return true;
    }
    catch(e) {
      return false;
    }
  };

};


var pbState = new PanelbarState();
pbState.init();
