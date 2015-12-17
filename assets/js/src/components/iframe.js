
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
    addClass(panelBar.visBtn.children[0], 'fa-' + (clear ? 'thumb-tack' : 'times-circle'));
    removeClass(panelBar.visBtn.children[0], 'fa-' + (!clear ? 'thumb-tack' : 'times-circle'));
    panelBar.visBtn[clear ? 'addEventListener' : 'removeEventListener']('click', self.redirect);
  };

  this.setPosition = function(clear) {
   var position = panelBar.position;
    panelBar[clear ? 'top' : self.position]();
    self.position = clear ? position : null;
  }

  /**
   *  iframe & window loading
   */

  this.load     = function(url) {
    // start loading
    self.loading.innerHTML = 'Loading…';
    self.iframe.src = self.active ? url : '';

    // clear if panel got loaded
    self.iframe.addEventListener("load", function() {
      var body = self.iframe.contentDocument.querySelector('body.app');
      if(typeof body !== undefined) self.loading.innerHTML = '';
    });

    // wait and check if loading got cleared, if not redirect
    setTimeout(function() {
      if(self.loading.innerHTML !== '') {
        self.loading.innerHTML = 'Seems like something is blocking access to the panel inside an iframe. Redirecting…';
        setTimeout(function() {
          location.href = url;
        }, 2000);
      }
    }, 1500);
  };

  this.refresh  = function()    {
    location.reload();
  };

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
    testFrame.addEventListener("load", function() {
      var body = testFrame.contentDocument.querySelector('body.app');
      if(typeof body !== undefined) document.body.removeChild(testFrame);
    });

    setTimeout(function() {
      self.supported = document.getElementById('panelBarJStestFrame') === null;
    }, 1000);
  };


  self.support();
};


if ('querySelector' in document && 'addEventListener' in window) {
  var pbIframe = new panelBarIframe();
}
