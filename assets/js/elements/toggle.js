
var PanelbarToggle = function(element) {

  var self = this;

  this.button = element.children[0];
  this.icon   = this.button.children[0];
  this.text   = this.button.children[1];
  this.status = this.text.innerHTML === 'Visible' ? 'hide' : 'publish';



  this.init = function() {
    self.button.addEventListener('click', self.click);
  };

  this.click = function(e) {
    e.preventDefault();
    self.request();

    if(self.status === 'publish') {
      removeClass(self.icon, 'fa-toggle-off');
      addClass(self.icon, 'fa-toggle-on');
      self.text.innerHTML = "Visible";
    } else {
      removeClass(self.icon, 'fa-toggle-on');
      addClass(self.icon, 'fa-toggle-off');
      self.text.innerHTML = "Invisible";
    }

    setTimeout(function() {
      location.reload();
    }, 200);
  };

  this.request = function() {
    var url = siteURL + "/panel/api/pages/" + self.status + "/" + currentURI;
    var request = new XMLHttpRequest();
    request.open('POST', url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send();
  };

};


if ('querySelector' in document && 'addEventListener' in window) {
  var toggle   = document.querySelector(".panelbar--toggle");
  var toggleJS = new PanelbarToggle(toggle);
  toggleJS.init();
}
