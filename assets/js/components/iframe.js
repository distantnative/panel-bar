
var PanelBarIframe = function(elements) {

  var self = this;

  this.active     = false;
  this.link       = null;
  this.href       = null;
  this.wrapper    = PanelBar.wrapper.querySelector(".panelbar-iframe__iframe");
  this.iframe     = this.wrapper.children[1];
  this.loading    = this.wrapper.children[0];
  this.buttons    = PanelBar.bar.querySelector(".panelbar-iframe__btns");
  this.returnBtn  = this.buttons.children[0];
  this.refreshBtn = this.buttons.children[1];
  this.elements   = PanelBar.wrapper.querySelectorAll('.panelbar__bar > div');
  this.position   = null;
  this.supported  = true;


  this.init = function(elements) {
    self.support();
    var iframelinks = PanelBar.bar.querySelectorAll(elements.join());
    var i;
    for(i = 0; i < iframelinks.length; i++) {
      iframelinks[i].addEventListener('click', function(e) {
        if(self.supported) {
          e.preventDefault();
          self.activate(this);
        }
      });
    }
  };

  this.support = function() {
    var testFrame = document.createElement('iframe');
    testFrame.style.display = 'none';
    testFrame.id            = 'PanelBarJStestFrame'
    testFrame.src           = siteURL + '/panel/';
    document.body.appendChild(testFrame);
    testFrame.addEventListener("load", function() {
      document.body.removeChild(testFrame);
    });

    setTimeout(function() {
      var testFrame = document.getElementById('PanelBarJStestFrame');
      if(testFrame === null) {
        self.supported = true;
      } else {
        self.supported = false;
      }
    }, 2500);
  };

  this.activate = function(link) {
    self.link     = link;
    self.href     = self.link.href;
    self.position = PanelBar.position;
    self.active   = true;

    self.load();
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

  this.load = function() {
    self.iframe.src = self.href;
  };

  this.unload = function() {
    self.iframe.src = "";
  };

  this.buildOverlay = function() {
    self.buttons.style.display   = 'inline-block';
    self.wrapper.style.display   = 'block';
    document.body.style.overflow = 'hidden';
    addClass(PanelBar.wrapper, 'panelbar--iframe');

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
    removeClass(PanelBar.wrapper, 'panelbar--iframe');
    self.loading.innerHTML       = '';

    self.returnBtn.removeEventListener('click', self.deactivate);
    self.refreshBtn.removeEventListener('click', self.refresh);
  };


  this.clearPanelbar = function() {
    self._elements('none');
    PanelBar.posBtn.style.display = 'none';
    PanelBar.visBtn.addEventListener('click', self.redirectClose);
  };

  this.restorePanelbar = function() {
    self._elements('inline-block');
    PanelBar.posBtn.style.display = '';
    PanelBar.visBtn.removeEventListener('click', self.redirectClose);
  };

  this._elements = function(display) {
    var i;
    for (i = 0; i < self.elements.length; i++) {
      self.elements[i].style.display = display;
    }
  };

  this.redirectClose = function() {
    location.href = self.iframe.src;
    PanelBar.show();
  };

  this.clearPosition = function() {
    PanelBar.top();
  };

  this.restorePosition = function() {
    if(self.position === 'bottom') {
      PanelBar.bottom();
    }
  };

  this.init(elements);
};


if ('querySelector' in document && 'addEventListener' in window) {
  var elements = ['.panelbar--panel a',
                  '.panelbar--add a',
                  '.panelbar--edit a',
                  '.panelbar--user a',
                  '.panelbar-fileviewer__item',
                  '.panelbar-fileviewer__more',
                  '.panelbar-filelist__item',
                  '.panelbar-filelist__more',];
  var pbIframe = new PanelBarIframe(elements);
}
