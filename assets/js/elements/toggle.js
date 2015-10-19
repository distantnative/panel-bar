
var panelBarToggle = function(toggle) {

  var self = this;

  this.button  = toggle.children[0];
  this.icon    = this.button.children[0];
  this.text    = this.button.children[1];
  this.links   = toggle.querySelectorAll(".panelBar-drop__list > a");
  this.status  = this.text.innerHTML === 'Visible';
  this.action  = this.status ? 'hide' : 'sort';


  this.init = function() {
    if(self.status) {
      self.button.addEventListener('click', self.click);

    } else {
      self.button.style.cursor = 'default';
      var i;
      for (i = 0; i < self.links.length; i++) {
        self.links[i].setAttribute('data-num' , (i + 1));
        self.links[i].addEventListener('click', self.click);
      }
    }
  };

  this.click = function(e) {
    e.preventDefault();

    addClass   (self.icon, 'fa-toggle-' + (self.status ? 'off' : 'on'));
    removeClass(self.icon, 'fa-toggle-' + (self.status ? 'on'  : 'off'));
    self.text.innerHTML = self.status ? "Invisible" : "Visible";

    self.request(e.target.getAttribute('data-num'));
  };

  this.request = function(num) {
    var url     = siteURL + "/panel/api/pages/" + self.action + "/" + currentURI;
    var request = new XMLHttpRequest();
    request.open('POST', url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.onreadystatechange = function() {
      if (request.readyState === 4 && request.status === 200) location.reload();
    };
    request.send('to=' + num);
  };

  this.init();
};


if ('querySelector' in document && 'addEventListener' in window) {
  var pbToggle = new panelBarToggle(document.querySelector(".panelBar--toggle"));
}
