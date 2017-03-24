(function (panelBar) {

  var save = function() {
    _.set('expires',  Date.now() + (24 * 60 * 60 * 1000));
    _.set('position', panelBar.status.position);
    _.set('visible',  panelBar.status.visible ? 'show' : 'hide');
  };

  var restore = function() {
    panelBar[_.get('position')]();
    panelBar[_.get('visible')]();
  };

  var reset = function() {
    _.unset('expires');
    _.unset('position');
    _.unset('visibile');
  };

  var expired = function() {
    return Date.now() > _.get('expires');
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
      else          restore();

      save();
      panelBar.dom.controls.all.addEventListener('click', save);
    },

    update: save,

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

  var _ = panelBar.state;

})(panelBar);

panelBar.state.init();
