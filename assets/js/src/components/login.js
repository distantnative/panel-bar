
var loginBtn = document.getElementById('panelBar_login');
var state    = localStorage.getItem('panelBar.expires');

 if(Date.now() <= state) {
   loginBtn.addEventListener('click', function() {
     location.href = PANEL_URL;
   });
 } else {
   loginBtn.remove();
 }
