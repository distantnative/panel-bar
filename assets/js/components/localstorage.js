
var panelBarState = function() {

  var self = this;

  this.init = function() {
      if(Date.now() > localStorage.getItem('panelBar.expires')) {
        self.reset();
      } else {
        self.restore();
      }
      self.save();
      panelBar.controls.addEventListener('click', self.save);
  };

  this.get = function(key) {
    return localStorage.getItem('panelBar.' + key);
  };

  this.set = function(key, value) {
    return localStorage.setItem('panelBar.' + key, value);
  };

  this.unset = function(key) {
    return localStorage.removeItem('panelBar.' + key);
  };

  this.save = function() {
    self.set('expires',  Date.now() + (24 * 60 * 60 * 1000));
    self.set('position', panelBar.position);
    self.set('visible',  panelBar.visible ? 'show' : 'hide');
  };

  this.restore = function() {
    panelBar[self.get('position')]();
    panelBar[self.get('visible')]();
  };

  this.reset = function() {
    self.unset('expires');
    self.unset('position');
    self.unset('visibile');
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

  if(this.support()) { this.init(); }
};

var pbState = new panelBarState();
