
var panelBarIframe = function(elements) {

  var self = this;

  this.active     = false;
  this.position   = null;
  this.supported  = true;
  this.wrapper    = panelBar.wrapper.querySelector(".panelBar-iframe__iframe");
  this.iframe     = this.wrapper.children[1];
  this.loading    = this.wrapper.children[0];
  this.buttons    = panelBar.bar.querySelector(".panelBar-iframe__btns");
  this.returnBtn  = this.buttons.children[0];
  this.refreshBtn = this.buttons.children[1];
  this.elements   = panelBar.wrapper.querySelectorAll('.panelBar__bar > div');


  this.init = function() {
    self.support();
  };

  this.add = function(elements) {
    var iframelinks = panelBar.bar.querySelectorAll(elements.join());
    var i;
    for(i = 0; i < iframelinks.length; i++) {
      iframelinks[i].addEventListener('click', function(e) {
        if(self.supported) {
          e.preventDefault();
          self.activate(this.href);
        }
      });
    }
  };

  this.support = function() {
    var testFrame = document.createElement('iframe');
    testFrame.style.display = 'none';
    testFrame.id            = 'panelBarJStestFrame'
    testFrame.src           = siteURL + '/panel/';
    document.body.appendChild(testFrame);
    testFrame.addEventListener("load", function() {
      document.body.removeChild(testFrame);
    });

    setTimeout(function() {
      var testFrame = document.getElementById('panelBarJStestFrame');
      if(testFrame === null) {
        self.supported = true;
      } else {
        self.supported = false;
      }
    }, 2500);
  };

  this.activate = function(url) {
    self.position = panelBar.position;
    self.active   = true;

    self.load(url);
    self.clearPosition();
    self.clearPanelbar();
    self.buildOverlay();
  };

  this.deactivate = function() {
    self.restorePanelbar();
    self.removeOverlay();
    self.restorePosition();
    self.unload();

    self.active = false;
  };

  this.refresh = function() {
    location.reload();
  };

  this.load = function(url) {
    self.iframe.src = url;
  };

  this.unload = function() {
    self.iframe.src = "";
  };

  this.buildOverlay = function() {
    self.buttons.style.display   = 'inline-block';
    self.wrapper.style.display   = 'block';
    document.body.style.overflow = 'hidden';
    addClass(panelBar.wrapper, 'panelBar--iframe');

    self.loading.innerHTML   = 'Loading…';
    setTimeout(function() {
      self.loading.innerHTML = 'Seems like something is blocking access to the panel inside an iframe.';
    }, 3000);

    self.returnBtn.addEventListener('click', self.deactivate);
    self.refreshBtn.addEventListener('click', self.refresh);
  };

  this.removeOverlay = function() {
    self.buttons.style.display   = 'none';
    self.wrapper.style.display   = 'none';
    document.body.style.overflow = 'auto';
    removeClass(panelBar.wrapper, 'panelBar--iframe');
    self.loading.innerHTML       = '';

    self.returnBtn.removeEventListener('click', self.deactivate);
    self.refreshBtn.removeEventListener('click', self.refresh);
  };


  this.clearPanelbar = function() {
    self._elements('none');
    panelBar.posBtn.style.display = 'none';
    panelBar.visBtn.addEventListener('click', self.redirectClose);
  };

  this.restorePanelbar = function() {
    self._elements('inline-block');
    panelBar.posBtn.style.display = '';
    panelBar.visBtn.removeEventListener('click', self.redirectClose);
  };

  this._elements = function(display) {
    var i;
    for (i = 0; i < self.elements.length; i++) {
      self.elements[i].style.display = display;
    }
  };

  this.redirectClose = function() {
    location.href = self.iframe.src;
    panelBar.show();
  };

  this.clearPosition = function() {
    panelBar.top();
  };

  this.restorePosition = function() {
    if(self.position === 'bottom') {
      panelBar.bottom();
    }
  };

  this.init(elements);
};


if ('querySelector' in document && 'addEventListener' in window) {
  var pbIframe = new panelBarIframe();
}
