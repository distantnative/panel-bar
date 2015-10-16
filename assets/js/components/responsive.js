
var panelBarResponsive = function() {

  var self = this;

  this.wrapper  = panelBar.wrapper;
  this.bar      = panelBar.bar;
  this.controls = panelBar.controls;
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
    removeClass(self.wrapper, 'panelBar--compact');
    addClass(self.wrapper, 'panelBar--mobile');
    self.mobile  = self.width();

    removeClass(self.wrapper, 'panelBar--mobile');
    self.desktop = self.width();

    self.setView();
  };

  this.setView = function() {
    if(self.wrapper.offsetWidth < self.mobile) {
      addClass(self.wrapper, 'panelBar--compact');
      addClass(self.wrapper, 'panelBar--mobile');
    } else if(self.wrapper.offsetWidth < self.desktop) {
      removeClass(self.wrapper, 'panelBar--compact');
      addClass(self.wrapper, 'panelBar--mobile');
    } else {
      removeClass(self.wrapper, 'panelBar--compact');
      removeClass(self.wrapper, 'panelBar--mobile');
    }
  };

  this.width = function() {
    var width    = self.controls.offsetWidth + 40;
    var i;
    for (i = 0; i < self.bar.children.length; i++) {
      width = width + self.bar.children[i].offsetWidth;
    }
    return width;
  };


  // OVERLAP
  this.overlap = function() {
    var drops = self.bar.querySelectorAll('.js-overlap');
    var i;
    for(i = 0; i < drops.length; i++) {
      removeClass(drops[i], 'panelBar-element--overlapLeft');
      removeClass(drops[i], 'panelBar-element--overlapRight');
      var position = drops[i].getBoundingClientRect();

      if(position.left < 0) {
        addClass(drops[i], 'panelBar-element--overlapLeft');
      } else if (position.right < 0) {
        addClass(drops[i], 'panelBar-element--overlapRight');
      }
    }
  };

  this.init();
}


if ('querySelector' in document && 'addEventListener' in window) {
  var pbResponsive = new panelBarResponsive();
}
