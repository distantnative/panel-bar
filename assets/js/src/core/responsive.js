(function (panelBar) {

  var wrapper = panelBar.dom.wrapper;

  var measure = function() {
    var visible = panelBar.status.visible;
    if(!visible) panelBar.show();

    cl.add   (wrapper, 'panelBar--mobile');
    _.data.mobile = width();

    cl.remove(wrapper, 'panelBar--mobile');
    _.data.desktop = width();

    if(!visible) panelBar.hide();

    set();
  };

  var set = function() {
    var space = wrapper.offsetWidth;
    if(!panelBar.status.visible) {
      panelBar.show();
      space = wrapper.offsetWidth;
      panelBar.hide();
    }

    if(space < _.data.desktop) {
      cl.add   (wrapper, 'panelBar--mobile');
    } else {
      cl.remove(wrapper, 'panelBar--mobile');
    }

    overlap();
  };

  var width = function() {
    var width    = panelBar.dom.controls.all.offsetWidth + 20;
    var elements = panelBar.dom.bar.querySelectorAll('.panelBar-element');
    var i;
    for (i = 0; i < elements.length; i++) {
      width = width + elements[i].offsetWidth;
    }
    return width;
  };

  var overlap = function() {
    var mDrop = panelBar.dom.bar.querySelectorAll('.panelBar-mDrop');
    var i;
    for(i = 0; i < mDrop.length; i++) {
      cl.remove(mDrop[i], 'panelBar-element--overlap');
      var position = mDrop[i].getBoundingClientRect();
      if(position.left < 0) {
        cl.add(mDrop[i], 'panelBar-element--overlap');
      } else if (position.right < 0) {
        cl.add(mDrop[i], 'panelBar-element--overlap');
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
      setTimeout(measure, 300);
      window.addEventListener('resize', set);
    },
  };

  var _ = panelBar.responsive;

})(panelBar);

panelBar.responsive.init();
