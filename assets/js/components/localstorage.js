
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

  this.save = function() {
    localStorage.setItem('panelBar.expires',  Date.now() + (24 * 60 * 60 * 1000));
    localStorage.setItem('panelBar.position', panelBar.position);
    localStorage.setItem('panelBar.visible',  panelBar.visible ? 'show' : 'hide');
  };

  this.restore = function() {
    panelBar[localStorage.getItem('panelBar.position')]();
    panelBar[localStorage.getItem('panelBar.visible')]();
  };

  this.reset = function() {
    localStorage.removeItem('panelBar.expires');
    localStorage.removeItem('panelBar.position');
    localStorage.removeItem('panelBar.visibile');
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
