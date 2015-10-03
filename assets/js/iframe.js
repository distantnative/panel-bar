
var PanelbarIframe = function() {

  var self = this;

  this.link       = null;
  this.href       = null;
  this.wrapper    = document.querySelector(".panelbar-iframe__iframe");
  this.iframe     = this.wrapper.children[0];
  this.buttons    = document.querySelector(".panelbar-iframe__btns");
  this.returnBtn  = document.querySelector(".js_panelbar-iframe-close");
  this.refreshBtn = document.querySelector(".js_panelbar-iframe-closerefresh");
  this.panelbar   = document.getElementById("panelbar");
  this.elements   = document.querySelectorAll(".panelbar__bar > div");
  this.controls   = document.getElementById("panelbar_controls");
  this.position   = null;


  this.init = function(elements) {
    var iframelinks = document.querySelectorAll(elements);
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
    self.position = hasClass(self.panelbar, 'panelbar--top') ? 'top' : 'bottom';

    self.clearPanelbar();
    self.buildOverlay();
    self.clearPosition();

    self.load();
    setTimeout(self.bindSubmit, 500);
  };

  this.deactivate = function() {
    self.restorePanelbar();
    self.removeOverlay();
    self.restorePosition();
  };

  this.refresh = function() {
    location.reload();
  };

  this.load = function(href) {
    self.iframe.src = self.href;
  };


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
    self.controls.style.display = display;
  };


  this.clearPosition = function() {
    removeClass(self.panelbar, 'panelbar--bottom');
    addClass(self.panelbar, 'panelbar--top');
  };

  this.restorePosition = function() {
    removeClass(self.panelbar, 'panelbar--top');
    addClass(self.panelbar, 'panelbar--' + self.position);
  };
};





if ('querySelector' in document && 'addEventListener' in window) {
  var panelbarIframe = new PanelbarIframe();
  panelbarIframe.init('.panelbar--add a, .panelbar--edit a, .panelbar-fileviewer__item, .panelbar-fileviewer__more');
}
