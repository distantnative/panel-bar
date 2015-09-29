var addBtnIframe = function (e) {
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
  var addBtn = document.getElementById('panelbar--add').children[1];
  addBtn.children[0].addEventListener('click', addBtnIframe);
  addBtn.children[1].addEventListener('click', addBtnIframe);

  var editBtn = document.getElementById('panelbar--edit').children[0];
  editBtn.addEventListener('click', addBtnIframe);

  var returnBtn = document.querySelector(".panelbar-return__btn");
  returnBtn.addEventListener('click', returnFromIframe);
  switchbtn.addEventListener('click', returnFromIframe);
}
