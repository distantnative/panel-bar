
var panelBar = (function (panelBar) {

  var _ = {};

  _.elements = {};

  _.dom = {
    wrapper:  document.getElementById('panelBar'),
    bar:      document.getElementById('panelBar_bar'),
    controls: document.getElementById('panelBar_controls'),
  };

  _.dom.buttons = {
    position: _.dom.controls.children[0],
    visible:  _.dom.controls.children[1],
  };

  _.status = {
    visible:   !cl.has(_.dom.bar, 'panelBar__bar--hidden'),
    position:  cl.has(_.dom.wrapper, 'panelBar--top') ? 'top' : 'bottom',
  };

  _.init = function() {
    if (isSupported()) {
      activateControls();
    } else  {
      _.deactivate();
    }
  };

  var activateControls = function() {
    _.dom.buttons.position.addEventListener('click', _.togglePosition);
    _.dom.buttons.visible.addEventListener('click', _.toggleVisibility);
  };


  var pos = function(top) {
    _.status.position = top ? 'top' : 'bottom';
    cl.add   (_.dom.wrapper, 'panelBar--' + _.status.position);
    cl.remove(_.dom.wrapper, 'panelBar--' + (top ? 'bottom' : 'top'));
  };

  _.top =            function() { pos(true);                        };
  _.bottom =         function() { pos(false);                       };
  _.togglePosition = function() { pos(_.status.position !== 'top'); };

  var vis = function(vis) {
    _.status.visible = vis;
    cl[vis ? 'remove' : 'add'](_.dom.wrapper, 'panelBar--hidden');
  };

  _.show =             function() { vis(true);              };
  _.hide =             function() { vis(false);             };
  _.toggleVisibility = function() { vis(!_.status.visible); };

  var isSupported = function() {
    return 'querySelector' in document && 'addEventListener' in window;
  };

  _.deactivate = function() {
    _.dom.controls.remove();
    _.dom.bar.style.paddingRight = 0;
    cl.remove(_.dom.bar, "panelBar--hidden");
  };

  return _;
})();

panelBar.init();
