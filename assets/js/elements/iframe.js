var panelIframe = function (e) {
  e.preventDefault();
  var href      = this.href;
  var returnBtn = document.querySelector(".panelbar-return__btn");
  var returnIF  = document.querySelector(".panelbar-return__iframe");
  var returnIFF = document.querySelector(".panelbar-return__iframe > iframe");
  var elements  = document.querySelectorAll(".panelbar__bar > div");
  var i;
  for (i = 0; i < elements.length; i++) {
    elements[i].style.display = "none";
  }
  returnBtn.style.display = "inline-block";
  returnIF.style.display  = "block";
  returnIFF.src           = href;

  document.body.style.overflow = 'hidden';
};

var returnFromIframe = function () {
  location.reload();
};



if ( 'querySelector' in document && 'addEventListener' in window ) {
  var panellinks = document.querySelectorAll('.panelbar--add a, .panelbar--edit a, .panelbar--toggle a, .panelbar-fileviewer__item, .panelbar-fileviewer__more');
  var i;
  for (i = 0; i < panellinks.length; i++) {
    panellinks[i].addEventListener('click', panelIframe);
  }

  var returnBtn = document.querySelector(".panelbar-return__btn");
  returnBtn.addEventListener('click', returnFromIframe);
  switchbtn.addEventListener('click', returnFromIframe);
}
