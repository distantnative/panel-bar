
var cl = (function (classes) {
  var _ = {
    has: function (elem, className) {
      return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
    },
    add: function (elem, className) {
      if (!_.has(elem, className)) {
        elem.className += ' ' + className;
      }
    },
    remove: function (elem, className) {
      var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, ' ') + ' ';
      if (_.has(elem, className)) {
        while (newClass.indexOf(' ' + className + ' ') >= 0 ) {
          newClass = newClass.replace(' ' + className + ' ', ' ');
        }
        elem.className = newClass.replace(/^\s+|\s+$/g, '');
      }
    }
  };

  return _;
})();
