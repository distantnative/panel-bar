
var PanelbarState = function() {
  var self = this;

  this.validTime = 24 * 60 * 60 * 1000;


  self.init = function() {
    if(self.support()) {

      if(self.expired()) { self.reset();   }
      else               { self.restore(); }

      self.save();
      panelbar.controls.addEventListener('click', self.save);

    } else {
      console.log('PanelBar: localStorage not supported');
    }
  };


  this.save = function() {
    localStorage['panelbar.expires']  = Date.now() + self.validTime;
    localStorage['panelbar.position'] = panelbar.position;
    localStorage['panelbar.visible']  = panelbar.visible;
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
    if (localStorage['panelbar.position'] === 'top') { panelbar.top();    }
    else                                             { panelbar.bottom(); }
  };

  this.setVisibility = function() {
    if (localStorage['panelbar.visible'] === 'true') { panelbar.show(); }
    else                                             { panelbar.hide(); }
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
