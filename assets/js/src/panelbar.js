var panelBar = (function (panelBar) {

  var _ = {};


  _.elements = {};

  var controls = document.getElementById('panelBar-controls');

  _.dom = {
    wrapper:    document.getElementById('panelBar'),
    bar:        document.getElementById('panelBar-main'),
    controls: {
      all:      controls,
      position: controls.children[0],
      visible:  controls.children[1],
    },
  };

  _.status = {
    visible:   !cl.has(_.dom.bar, 'panelBar--hidden'),
    position:   cl.has(_.dom.wrapper, 'panelBar--top') ? 'top' : 'bottom',
  };

  _.init = function() {
    if(isSupported())   activate();
    else              _.deactivate();
  };

  var activate = function() {
    _.dom.controls.position.addEventListener('click', _.togglePosition);
    _.dom.controls.visible.addEventListener('click', _.toggleVisibility);
  };

  _.deactivate = function() {
    _.dom.controls.all.remove();
    _.dom.bar.style.paddingRight = 0;
    cl.remove(_.dom.bar, "panelBar--hidden");
  };


  // =============================================
  //  Position
  // =============================================

  var pos = function(top) {
    _.status.position = top ? 'top' : 'bottom';
    cl.remove(_.dom.wrapper, 'panelBar--' + (top ? 'bottom' : 'top'));
    cl.add   (_.dom.wrapper, 'panelBar--' + _.status.position);
  };

  _.top            = function() { pos(true);                        };
  _.bottom         = function() { pos(false);                       };
  _.togglePosition = function() { pos(_.status.position !== 'top'); };


  // =============================================
  //  Visibility
  // =============================================

  var vis = function(vis) {
    _.status.visible = vis;
    cl[vis ? 'remove' : 'add'](_.dom.wrapper, 'panelBar--hidden');
  };

  _.show             = function() { vis(true);              };
  _.hide             = function() { vis(false);             };
  _.toggleVisibility = function() { vis(!_.status.visible); };


  // =============================================
  //  Checks
  // =============================================

  var isSupported = function() {
    return 'querySelector' in document && 'addEventListener' in window;
  };

  return _;
})();

panelBar.init();
