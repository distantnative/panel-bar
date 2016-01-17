(function (panelBar) {

  var keys = function(e) {
    e = e || event;

    if(!e.altKey) return;
    if(iFrameIsActive()) return;

    var shortcut = _.bindings[e.keyCode];
    if(shortcut) {
      shortcut();
      if(typeof panelBar.iframe !== 'undefined') panelBar.state.update();
    }

  };

  var iFrameIsActive = function() {
    return typeof panelBar.iframe !== 'undefined' && panelBar.iframe.status.active === true;
  };

  panelBar.keys = {
    init: function() {
      document.addEventListener('keydown', keys);
    },

    bindings: {
      // alt + X
      88: function() {
        panelBar.toggleVisibility();

      },
      // alt + - (dash)
      189: function() {
        panelBar.togglePosition();
      },
      // alt + arrow-up
      38: function() {
        panelBar.top();
      },
      // alt + arrow-down
      40: function() {
        panelBar.bottom();
      },
      // alt + M
      77: function() {
        panelBar.dom.bar.querySelector('.panelBar--edit a').click();
      },
      // alt + P
      80: function() {
        location.href = panelBar.dom.bar.querySelector('.panelBar--panel a').href;
      },
    },
  };

  var _ = panelBar.keys;

})(panelBar);

panelBar.keys.init();
