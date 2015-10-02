
var PanelbarIframe = function() {

  var self = this;

  this.link      = null;
  this.href      = null;
  this.wrapper   = document.querySelector(".panelbar-return__iframe");
  this.iframe    = this.wrapper.children[0];
  this.returnBtn = document.querySelector(".panelbar-return__btn");
  this.panelbar  = document.getElementById("panelbar");
  this.elements  = document.querySelectorAll(".panelbar__bar > div");
  this.position  = null;
  this.form      = null;
  this.submitted = false;


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
    if (self.submitted) {
      location.reload();

    } else {
      self.restorePanelbar();
      self.removeOverlay();
      self.restorePosition();
      self.unbindSubmit();
    }
  };

  this.load = function(href) {
    self.iframe.src = self.href;
  };

  this.bindSubmit = function() {
    self.clearSubmit();

    var inner     = self.iframe.contentDocument || self.iframe.contentWindow.document;
    self.form     = inner.querySelector('.form');
    self.form.addEventListener('submit', self.setSubmit);
  };

  this.unbindSubmit = function() {
    self.form.removeEventListener('submit', self.setSubmit);
  };

  this.setSubmit   = function() { self.submitted = true; }
  this.clearSubmit = function() { self.submitted = false; }


  this.buildOverlay = function() {
    self.returnBtn.style.display = 'inline-block';
    self.wrapper.style.display   = 'block';
    document.body.style.overflow = 'hidden';

    self.returnBtn.addEventListener('click', self.deactivate);
  };

  this.removeOverlay = function() {
    self.returnBtn.style.display = 'none';
    self.wrapper.style.display   = 'none';
    document.body.style.overflow = 'auto';

    self.returnBtn.removeEventListener('click', self.deactivate);
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





if ( 'querySelector' in document && 'addEventListener' in window ) {
  var iframelinks    = document.querySelectorAll('.panelbar--add a, .panelbar--edit a, .panelbar--toggle a, .panelbar-fileviewer__item, .panelbar-fileviewer__more');
  var panelbarIframe = new PanelbarIframe();

  var i;
  for (i = 0; i < iframelinks.length; i++) {
    iframelinks[i].addEventListener('click', function(e) {
      e.preventDefault();
      panelbarIframe.activate(this);
    });
  }


}
