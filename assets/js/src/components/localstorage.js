(function (panelBar) {

  var save = function() {
    panelBar.state.set('expires',  Date.now() + (24 * 60 * 60 * 1000));
    panelBar.state.set('position', panelBar.status.position);
    panelBar.state.set('visible',  panelBar.status.visible ? 'show' : 'hide');
  };

  var restore = function() {
    panelBar[panelBar.state.get('position')]();
    panelBar[panelBar.state.get('visible')]();
  };

  var reset = function() {
    panelBar.state.unset('expires');
    panelBar.state.unset('position');
    panelBar.state.unset('visibile');
  };

  var expired = function() {
    return Date.now() > panelBar.state.get('expires');
  };

  var isSupported = function() {
    try {
      var x = '__panelBar_storage_test__';
      localStorage.setItem(x, x);
      localStorage.getItem(x);
      localStorage.removeItem(x);
      return true;
    } catch(e) {
      return false;
    }
  };

  panelBar.state = {
    init: function() {
      if(!isSupported()) return;

      if(expired()) reset();
      else restore();

      save();
      panelBar.dom.controls.addEventListener('click', save);
    },

    get: function(key) {
      return localStorage.getItem('panelBar.' + key);
    },
    set: function(key, value) {
      return localStorage.setItem('panelBar.' + key, value);
    },
    unset: function(key) {
      return localStorage.removeItem('panelBar.' + key);
    },
  };
})(panelBar);

panelBar.state.init();
