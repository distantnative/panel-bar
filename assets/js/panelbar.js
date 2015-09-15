
// Class handler functions

var hasClass = function (elem, className) {
  return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
}

var addClass = function (elem, className) {
  if (!hasClass(elem, className)) {
    elem.className += ' ' + className;
  }
}

var removeClass = function (elem, className) {
  var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, ' ') + ' ';
  if (hasClass(elem, className)) {
    while (newClass.indexOf(' ' + className + ' ') >= 0 ) {
      newClass = newClass.replace(' ' + className + ' ', ' ');
    }
    elem.className = newClass.replace(/^\s+|\s+$/g, '');
  }
}


// Elements
var panelbar  = document.getElementById('panelbar');
var controls  = document.getElementById('panelbar_controls');
var switchbtn = document.getElementById('panelbar_switch');
var flipbtn   = document.getElementById('panelbar_flip');



if ( 'querySelector' in document && 'addEventListener' in window ) {

  // Visibility toggle & flip
  switchbtn.addEventListener('click', function (e) {
    if (hasClass(panelbar, 'panelbar--hidden')) {
      removeClass(panelbar, 'panelbar--hidden');
    } else {
      addClass(panelbar, 'panelbar--hidden');
    }
  });

  flipbtn.addEventListener('click', function (e) {
    if (hasClass(panelbar, 'panelbar--top')) {
      removeClass(panelbar, 'panelbar--top');
    } else {
      addClass(panelbar, 'panelbar--top');
    }

    if (hasClass(panelbar, 'panelbar--bottom')) {
      removeClass(panelbar, 'panelbar--bottom');
    } else {
      addClass(panelbar, 'panelbar--bottom');
    }

  });


} else {
  // remove switch in legacy Browser
  controls.remove();
  panelbar.style.paddingRight = 0;
  panelbar.classList.remove("panelbar--hidden");
}



// EnhancedJS with jQuery

if (jQuery && enhancedJS === true) {
  $(function() {

    // Element: toggle
    $(".panelbar--toggle > a").on("click", function (e) {
      e.preventDefault();

      var status = $(this).find('span').text() == 'Visible' ? 'hide' : 'publish';
      var url    = siteURL + "/panel/api/pages/" + status + "/" + currentURI;

      $.ajax({
        type: "POST",
        url: url
      });

      $(this).find('.fa').toggleClass('fa-toggle-off fa-toggle-on');
      $(this).find('span').text(status == "hide" ? "Invisible" : "Visible");

      setTimeout(function() {
        location.reload();
      }, 100);

    });


  });
}
