(function (panelBar) {

  var setOverlay = function(show) {
    _.dom.buttons.all.style.display = show ? 'inline-block' : 'none';
    _.dom.wrapper.style.display     = show ? 'block': 'none';
    document.body.style.overflow    = show ? 'hidden' : 'auto';

    var event = show ? 'addEventListener' : 'removeEventListener';
    _.dom.buttons.return[event]('click', _.show);
    _.dom.buttons.refresh[event]('click', refresh);
  };

  var setPanelbar = function(clear) {
    var elements = _.dom.elements;
    var i;
    for (i = 0; i < elements.length; i++) {
      elements[i].style.display = clear ? 'none' : 'inline-block';
    }
    var controls = panelBar.dom.controls;
    controls.position.style.display = clear ? 'none' : '';
    cl.add(controls.visible.children[0], 'fa-' + (clear ? 'thumb-tack' : 'times-circle'));
    cl.remove(controls.visible.children[0], 'fa-' + (!clear ? 'thumb-tack' : 'times-circle'));
    controls.visible[clear ? 'addEventListener' : 'removeEventListener']('click', redirect);
  };

  var setPosition = function(clear) {
    var position = panelBar.status.position;
    panelBar[clear ? 'top' : _.status.position]();
    _.status.position = clear ? position : null;
  };

  var refresh  = function() { location.reload(); };
  var redirect = function() {
    location.href = _.dom.iframe.src;
    panelBar.show();
  };


  panelBar.iframe = {};

  var parent  = panelBar.dom;
  var wrapper = parent.wrapper.querySelector(".panelBar-iframe__iframe");
  var buttons = parent.bar.querySelector(".panelBar-iframe__btns");

  panelBar.iframe.dom = {
    wrapper:    wrapper,
    iframe:     wrapper.children[1],
    loading:    wrapper.children[0],
    elements:   parent.wrapper.querySelectorAll('.panelBar__bar > div'),
    buttons: {
      all:      buttons,
      return:   buttons.children[0],
      refresh:  buttons.children[1],
    },
  };

  panelBar.iframe.status = {
    active:     false,
    position:   null,
    supported:  true,
  };

  panelBar.iframe.bind = function(element) {
    var links = panelBar.dom.bar.querySelectorAll(element);
    var i;
    for (i = 0; i < links.length; i++) {
      links[i].addEventListener('click', function(e) {
        if(_.status.supported) {
          e.preventDefault();
          _.show(this.href);
        }
      });
    }
  };

  panelBar.iframe.show = function(url) {
    _.status.active = /^(f|ht)tps?:\/\//i.test(url);
    setPosition(_.status.active);
    setPanelbar(_.status.active);
    setOverlay(_.status.active);
    _.load(url);
  };

  panelBar.iframe.load = function(url) {
    // start loading
    _.dom.loading.innerHTML = 'Loading…';
    _.dom.iframe.src = _.status.active ? url : '';

    // clear if panel got loaded
    _.dom.iframe.addEventListener("load", function() {
      var body = _.dom.iframe.contentDocument.querySelector('body.app');
      if(typeof body !== undefined) _.dom.loading.innerHTML = '';
      else setTimeout(redirect, 4000);
    });

    // wait and check if loading got cleared, if not redirect
    setTimeout(function() {
      if(_.dom.loading.innerHTML !== '') {
        _.loading.innerHTML = 'Seems like something is blocking access to the panel inside an iframe. Redirecting…';
        setTimeout(function() {
          location.href = url;
        }, 2000);
      }
    }, 1500);
  };

  panelBar.iframe.isSupported = function() {
    var testFrame = document.createElement('iframe');
    testFrame.id            = 'panelBarJStestFrame';
    testFrame.src           = siteURL + '/panel/';
    testFrame.style.display = 'none';

    document.body.appendChild(testFrame);
    testFrame.addEventListener("load", function() {
      var body = testFrame.contentDocument.querySelector('body.app');
      if(typeof body !== undefined) document.body.removeChild(testFrame);
    });

    setTimeout(function() {
      _.status.supported = document.getElementById('panelBarJStestFrame') === null;
    }, 1000);
  };

  var _ = panelBar.iframe;

})(panelBar);

panelBar.iframe.isSupported();
