
var PanelbarResponsive = function() {

  var self = this;

  this.wrapper  = panelbar.wrapper;
  this.panelbar = panelbar.panelbar;
  this.controls = panelbar.controls;
  this.resize   = null;
  this.mobile   = null;
  this.desktop  = null;



  this.init = function() {
    setTimeout(self.measureViews, 100);
    setTimeout(self.measureViews, 250);
    window.addEventListener('resize', self.setView);

    setTimeout(self.overlap, 250);
    window.addEventListener('resize', self.overlap);
  }

  // VIEWS
  this.setup = function() {

  }

  this.measureViews = function() {
    removeClass(self.wrapper, 'panelbar--compact');
    addClass(self.wrapper, 'panelbar--mobile');
    self.mobile  = self.width();

    removeClass(self.wrapper, 'panelbar--mobile');
    self.desktop = self.width();

    self.setView();
  };

  this.setView = function() {
    if(self.wrapper.offsetWidth < self.mobile) {
      addClass(self.wrapper, 'panelbar--compact');
      addClass(self.wrapper, 'panelbar--mobile');
    } else if(self.wrapper.offsetWidth < self.desktop) {
      removeClass(self.wrapper, 'panelbar--compact');
      addClass(self.wrapper, 'panelbar--mobile');
    } else {
      removeClass(self.wrapper, 'panelbar--compact');
      removeClass(self.wrapper, 'panelbar--mobile');
    }
  };

  this.width = function() {
    var width    = self.controls.offsetWidth + 40;
    var i;
    for (i = 0; i < self.panelbar.children.length; i++) {
      width = width + self.panelbar.children[i].offsetWidth;
    }
    return width;
  };


  // OVERLAP
  this.overlap = function() {
    var drops = panelbar.panelbar.querySelectorAll('.js-overlap');
    var i;
    for(i = 0; i < drops.length; i++) {
      removeClass(drops[i], 'panelbar-element--overlapLeft');
      removeClass(drops[i], 'panelbar-element--overlapRight');
      var position = drops[i].getBoundingClientRect();

      if(position.left < 0) {
        addClass(drops[i], 'panelbar-element--overlapLeft');
      } else if (position.right < 0) {
        addClass(drops[i], 'panelbar-element--overlapRight');
      }
    }
  };
}


if ('querySelector' in document && 'addEventListener' in window) {
  var panelbarResponsive = new PanelbarResponsive();
  panelbarResponsive.init();
}
