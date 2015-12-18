(function (panelBar) {

  var wrapper = panelBar.dom.wrapper;

  var measure = function() {
    cl.add   (wrapper, 'panelBar--mobile');
    cl.remove(wrapper, 'panelBar--compact');
    _.data.mobile = width();

    cl.remove(wrapper, 'panelBar--mobile');
    _.data.desktop = width();

    set();
  };

  var set = function() {
    if(wrapper.offsetWidth < _.data.mobile) {
      cl.add(wrapper, 'panelBar--compact');
      cl.add(wrapper, 'panelBar--mobile');
    } else if(wrapper.offsetWidth < _.data.desktop) {
      cl.add   (wrapper, 'panelBar--mobile');
      cl.remove(wrapper, 'panelBar--compact');
    } else {
      cl.remove(wrapper, 'panelBar--compact');
      cl.remove(wrapper, 'panelBar--mobile');
    }

    overlap();
  };

  var width = function() {
    var width = panelBar.dom.controls.all.offsetWidth + 20;
    var i;
    for (i = 0; i < panelBar.dom.bar.children.length; i++) {
      width = width + panelBar.dom.bar.children[i].offsetWidth;
    }
    return width;
  };

  var overlap = function() {
    var mDrop = panelBar.dom.bar.querySelectorAll('.panelBar-mDrop');
    var i;
    for(i = 0; i < mDrop.length; i++) {
      cl.remove(mDrop[i], 'panelBar-element--overlapLeft');
      cl.remove(mDrop[i], 'panelBar-element--overlapRight');
      var position = mDrop[i].getBoundingClientRect();
      if(position.left < 0) {
        cl.add(mDrop[i], 'panelBar-element--overlapLeft');
      } else if (position.right < 0) {
        cl.add(mDrop[i], 'panelBar-element--overlapRight');
      }
    }
  };

  var isSupported = function() {
    return 'querySelector' in document && 'addEventListener' in window;
  };

  panelBar.responsive = {
    data: {
      resize:   null,
      mobile:   null,
      desktop:  null,
    },
    init: function() {
      if(!isSupported) return;
      measure();
      setTimeout(measure, 100);
      setTimeout(measure, 300);
      window.addEventListener('resize', set);
    },
  };

  var _ = panelBar.responsive;

})(panelBar);

panelBar.responsive.init();
