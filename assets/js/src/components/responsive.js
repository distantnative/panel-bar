
var panelBarResponsive = function(wrapper) {

  var self = this;

  this.resize   = null;
  this.mobile   = null;
  this.desktop  = null;


  this.init = function() {
    self.measure();
    setTimeout(self.measure, 100);
    setTimeout(self.measure, 300);
    window.addEventListener('resize', self.set);
  }

  // VIEWS
  this.measure = function() {
    addClass   (wrapper, 'panelBar--mobile');
    removeClass(wrapper, 'panelBar--compact');
    self.mobile = self.width();

    removeClass(wrapper, 'panelBar--mobile');
    self.desktop = self.width();

    self.set();
  };

  this.set = function() {
    if(wrapper.offsetWidth < self.mobile) {
      addClass(wrapper, 'panelBar--compact');
      addClass(wrapper, 'panelBar--mobile');
    } else if(wrapper.offsetWidth < self.desktop) {
      addClass   (wrapper, 'panelBar--mobile');
      removeClass(wrapper, 'panelBar--compact');
    } else {
      removeClass(wrapper, 'panelBar--compact');
      removeClass(wrapper, 'panelBar--mobile');
    }

    self.overlap();
  };

  this.width = function() {
    var width    = panelBar.controls.offsetWidth + 20;
    var i;
    for (i = 0; i < panelBar.bar.children.length; i++) {
      var width = width + panelBar.bar.children[i].offsetWidth;
    }
    return width;
  };


  // OVERLAP
  this.overlap = function() {
    var mDrop = panelBar.bar.querySelectorAll('.panelBar-mDrop');
    var i;
    for(i = 0; i < mDrop.length; i++) {
      removeClass(mDrop[i], 'panelBar-element--overlapLeft');
      removeClass(mDrop[i], 'panelBar-element--overlapRight');
      var position = mDrop[i].getBoundingClientRect();

      if(position.left < 0) {
        addClass(mDrop[i], 'panelBar-element--overlapLeft');
      } else if (position.right < 0) {
        addClass(mDrop[i], 'panelBar-element--overlapRight');
      }
    }
  };

  this.init();
}


if ('querySelector' in document && 'addEventListener' in window) {
  var pbResponsive = new panelBarResponsive(panelBar.wrapper);
}
