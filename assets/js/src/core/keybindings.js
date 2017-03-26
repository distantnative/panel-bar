(function (panelBar) {

  var keys = function(e) {
    e = e || event;

    if(!e.altKey || isOverlayActive()) return;

    if(shortcut = _.bindings[e.keyCode]) {
      shortcut();
      if(typeof panelBar.state !== 'undefined') panelBar.state.update();
    }

  };

  var isOverlayActive = function() {
    return typeof panelBar.overlay !== 'undefined' && panelBar.overlay.status.active === true;
  };

  panelBar.keys = {
    init: function() {
      document.addEventListener('keydown', keys);
    },

    bindings: {
      // alt + X
      88: function() { panelBar.toggleVisibility(); },
      // alt + - (dash)
      189: function() { panelBar.togglePosition();  },
      // alt + arrow-up
      38: function() { panelBar.top();    },
      // alt + arrow-down
      40: function() { panelBar.bottom(); },
    },
  };

  var _ = panelBar.keys;

})(panelBar);

panelBar.keys.init();
