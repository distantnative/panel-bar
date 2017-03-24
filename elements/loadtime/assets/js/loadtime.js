(function (panelBar) {

  panelBar.elements.loadtime = {
    dom: {
      button: panelBar.dom.bar.querySelector(".panelBar--loadtime"),
    },

    init: function() {
      label.innerHTML = '…';
    },

    update: function() {
      label.innerHTML = ((window.performance.timing.loadEventStart - window.performance.timing.domLoading)/1000).toFixed(2);
    },
  };


  var _     = panelBar.elements.loadtime;
  var label = _.dom.button.children[0].children[1];

})(panelBar);

if("performance" in window) {
  if("timing" in window.performance) {
    panelBar.elements.loadtime.init();

    window.onload = function() {
      panelBar.elements.loadtime.update();
    };
  }
}
