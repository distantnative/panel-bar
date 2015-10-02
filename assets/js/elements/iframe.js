
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


  this.activate = function(link) {
    self.link     = link;
    self.href     = self.link.href;
    self.position = hasClass(self.panelbar, 'panelbar--top') ? 'top' : 'bottom';

    self.clearPanelbar();
    self.buildOverlay();
    self.clearPosition();

    self.load();
  };

  this.deactivate = function() {
    if (true) {
      self.restorePanelbar();
      self.removeOverlay();
      self.restorePosition();

    } else {
      location.reload();
    }
  };

  this.load = function(href) {
    self.iframe.src = self.href;
  };


  this.buildOverlay = function() {
    self.returnBtn.style.display = "inline-block";
    self.wrapper.style.display   = "block";
    document.body.style.overflow = 'hidden';

    self.returnBtn.addEventListener('click', self.deactivate);
  };

  this.removeOverlay = function() {
    self.returnBtn.style.display = "none";
    self.wrapper.style.display   = "none";
    document.body.style.overflow = "auto";

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
