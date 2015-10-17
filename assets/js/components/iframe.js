
var panelBarIframe = function() {

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


  /**
   *  add - binds elements to iFrame mode
   */

  this.add = function(element) {
    var links = panelBar.bar.querySelectorAll(element);
    var i;
    for (i = 0; i < links.length; i++) {
      links[i].addEventListener('click', function(e) {
        if(self.supported) {
          e.preventDefault();
          self.show(this.href);
        }
      });
    }
  };


  /**
   *  show/hide iFrame mode
   */

  this.show = function(url) {
    self.active = /^(f|ht)tps?:\/\//i.test(url);
    self.setPosition(self.active)
    self.setPanelbar(self.active);
    self.setOverlay(self.active);
    self.load(url);
  }

  this.setOverlay = function(show) {
    self.buttons.style.display   = show ? 'inline-block'  : 'none';
    self.wrapper.style.display   = show ? 'block'         : 'none';
    document.body.style.overflow = show ? 'hidden'        : 'auto';

    self.loadingScreen(show ? 'Loading…' : '');

    var event = show ? 'addEventListener' : 'removeEventListener';
    self.returnBtn[event]('click', self.show);
    self.refreshBtn[event]('click', self.refresh);
  };

  this.setPanelbar = function(clear) {
    var i;
    for (i = 0; i < self.elements.length; i++) {
      self.elements[i].style.display = clear ? 'none' : 'inline-block';
    }
    panelBar.posBtn.style.display    = clear ? 'none' : '';
    panelBar.visBtn[clear ? 'addEventListener' : 'removeEventListener']('click', self.redirect);
  };

  this.setPosition = function(clear) {
   var position = panelBar.position;
    panelBar[clear ? 'top' : self.position]();
    self.position = clear ? position : null;
  }

  /**
   *  loading and fail screen
   */

  this.loadingScreen = function(message) {
    self.loading.innerHTML   = message;
    if(message !== '') {
      setTimeout(function() {
        self.loading.innerHTML = 'Seems like something is blocking access to the panel inside an iframe.';
      }, 3000);
    }
  };

  /**
   *  iframe & window loading
   */

  this.load     = function(url) { self.iframe.src = self.active ? url : ''; };
  this.refresh  = function()    { location.reload(); };
  this.redirect = function()    {
    location.href = self.iframe.src;
    panelBar.show();
  };


  /**
   *  support - checks if panel urls can be opened in iFrame
   */

  this.support = function() {
    var testFrame = document.createElement('iframe');
    testFrame.id            = 'panelBarJStestFrame'
    testFrame.src           = siteURL + '/panel/';
    testFrame.style.display = 'none';

    document.body.appendChild(testFrame);
    testFrame.addEventListener("load", document.body.removeChild(testFrame));

    setTimeout(function() {
      self.supported = document.getElementById('panelBarJStestFrame') === null;
    }, 2500);
  };


  this.support();
};


if ('querySelector' in document && 'addEventListener' in window) {
  var pbIframe = new panelBarIframe();
}
