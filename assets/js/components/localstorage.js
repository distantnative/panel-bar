
var PanelBarState = function() {

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
      PanelBar.controls.addEventListener('click', self.save);
    }
  };

  this.save = function() {
    localStorage.setItem('panelbar.expires',  Date.now() + self.validTime);
    localStorage.setItem('panelbar.position', PanelBar.position);
    localStorage.setItem('panelbar.visible',  PanelBar.visible);
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
      PanelBar.top();
    } else {
      PanelBar.bottom();
    }
  };

  this.setVisibility = function() {
    if(localStorage.getItem('panelbar.visible') === 'true') {
      PanelBar.show();
    } else {
      PanelBar.hide();
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

  this.init();
};


var pbState = new PanelBarState();
