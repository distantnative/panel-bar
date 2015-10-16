
var panelBarState = function() {

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
      panelBar.controls.addEventListener('click', self.save);
    }
  };

  this.save = function() {
    localStorage.setItem('panelBar.expires',  Date.now() + self.validTime);
    localStorage.setItem('panelBar.position', panelBar.position);
    localStorage.setItem('panelBar.visible',  panelBar.visible);
  };

  this.restore = function() {
    self.setPosition();
    self.setVisibility();
  };

  this.reset = function() {
    localStorage.removeItem('panelBar.expires');
    localStorage.removeItem('panelBar.position');
    localStorage.removeItem('panelBar.visibile');
  };

  this.setPosition = function() {
    if(localStorage.getItem('panelBar.position') === 'top') {
      panelBar.top();
    } else {
      panelBar.bottom();
    }
  };

  this.setVisibility = function() {
    if(localStorage.getItem('panelBar.visible') === 'true') {
      panelBar.show();
    } else {
      panelBar.hide();
    }
  };


  this.expired = function() {
    return Date.now() > localStorage.getItem('panelBar.expires');
  };


  this.support = function() {
    try {
      var x = '__panelBar_storage_test__';
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


var pbState = new panelBarState();
