(function (panelBar) {

  panelBar.elements.loadtime = {
    dom: {
      button: panelBar.dom.bar.querySelector(".panelBar--loadtime"),
    },

    init: function() {
      panelBar.elements.loadtime.dom.label.innerHTML = '…';
      var start   = new Date().getTime();
      var request = new XMLHttpRequest();
      request.open('POST', window.location.href , true);
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
      request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200) {
          panelBar.elements.loadtime.dom.label.innerHTML = ((new Date().getTime() - start)/1000).toFixed(2);
        }
      };
      request.send('panelBar=0');
    },
  };

  panelBar.elements.loadtime.dom.label = panelBar.elements.loadtime.dom.button.children[0].children[1];

})(panelBar);

panelBar.elements.loadtime.init();
