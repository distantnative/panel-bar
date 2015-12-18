(function (panelBar) {

  var keys = function(e) {
    e = e || event;
    _.map[e.keyCode] = e.type === 'keydown';

    if(isIframeActivated()) return;

    for(var shortcut in _.bindings) {
      if(!_.bindings[shortcut](_.map)) break;
    }
  };

  var isIframeActivated = function() {
    return typeof panelBar.iframe !== 'undefined' && panelBar.iframe.status.active === true;
  };

  panelBar.keys = {
    init: function() {
      document.addEventListener('keydown', keys);
      document.addEventListener('keyup',   keys);
    },

    map: [],

    bindings: {
      altX: function(map) {
        if(map[18] && map[88]) panelBar.toggleVisibility();
        else return false;
      },
      altdash: function(map) {
        if(map[18] && map[189]) panelBar.togglePosition();
        else return false;
      },
      altup: function(map) {
        if(map[18] && map[38]) panelBar.top();
        else return false;
      },
      altdown: function(map) {
        if(map[18] && map[40]) panelBar.bottom();
        else return false;
      },
      altM: function(map) {
        if(map[18] && map[77]) panelBar.dom.bar.querySelector('.panelBar--edit a').click();
        else return false;
      },
      altP: function(map) {
        if(map[18] && map[80]) {
          panelBar.status.keys = [];
          location.href = panelBar.dom.bar.querySelector('.panelBar--panel a').href;
        } else {
          return false;
        }
      },
    },
  };

  var _ = panelBar.keys;

})(panelBar);

panelBar.keys.init();
