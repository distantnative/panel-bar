
var PanelbarIframe = function() {

  var self = this;

  this.link       = null;
  this.href       = null;
  this.wrapper    = document.querySelector(".panelbar-iframe__iframe");
  this.iframe     = this.wrapper.children[0];
  this.buttons    = document.querySelector(".panelbar-iframe__btns");
  this.returnBtn  = document.querySelector(".js_panelbar-iframe-close");
  this.refreshBtn = document.querySelector(".js_panelbar-iframe-closerefresh");
  this.elements   = document.querySelectorAll(".panelbar__bar > div");
  this.position   = null;


  this.init = function(elements) {
    var iframelinks = document.querySelectorAll(elements.join());
    var i;
    for (i = 0; i < iframelinks.length; i++) {
      iframelinks[i].addEventListener('click', function(e) {
        e.preventDefault();
        self.activate(this);
      });
    }
  };

  this.activate = function(link) {
    self.link     = link;
    self.href     = self.link.href;
    self.position = panelbar.position;

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
  };

  this.refresh = function() {
    location.reload();
  };

  this.load = function(href) {
    self.iframe.src = self.href;
  };

  this.unload = function(href) {
    self.iframe.src = "";
  }


  this.buildOverlay = function() {
    self.buttons.style.display   = 'inline-block';
    self.wrapper.style.display   = 'block';
    document.body.style.overflow = 'hidden';

    self.returnBtn.addEventListener('click', self.deactivate);
    self.refreshBtn.addEventListener('click', self.refresh);
  };

  this.removeOverlay = function() {
    self.buttons.style.display   = 'none';
    self.wrapper.style.display   = 'none';
    document.body.style.overflow = 'auto';

    self.returnBtn.removeEventListener('click', self.deactivate);
    self.refreshBtn.removeEventListener('click', self.refresh);
  };


  this.clearPanelbar = function() {
    self._elements('none');
  };

  this.restorePanelbar = function() {
    self._elements('inline-block');
  };

  this._elements = function(display) {
    var i;
    for (i = 0; i < self.elements.length; i++) {
      self.elements[i].style.display = display;
    }
    panelbar.controls.style.display = display;
  };


  this.clearPosition = function() {
    panelbar.top();
  };

  this.restorePosition = function() {
    if (self.position === 'bottom') { panelbar.bottom(); }
  };
};





if ('querySelector' in document && 'addEventListener' in window) {
  var elements = ['.panelbar--add a',
                  '.panelbar--edit a',
                  '.panelbar--user a',
                  '.panelbar-fileviewer__item',
                  '.panelbar-fileviewer__more'];
  var panelbarIframe = new PanelbarIframe();
  panelbarIframe.init(elements);
}
