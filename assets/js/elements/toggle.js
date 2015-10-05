
var PanelbarToggle = function(element) {

  var self = this;

  this.button    = element.children[0];
  this.droplinks = document.querySelectorAll(".panelbar-drop__list a");
  this.icon      = this.button.children[0];
  this.text      = this.button.children[1];
  this.status    = this.text.innerHTML === 'Visible' ? 'hide' : 'sort';


  this.init = function() {
    self.button.addEventListener('click', self.click);
    var i;
    for (i = 0; i < self.droplinks.length; i++) {
      self.droplinks[i].setAttribute('data-num' , i-1);
      self.droplinks[i].addEventListener('click', function(e){
        self.click(e);
      });
    }
  };

  this.click = function(e) {
    e.preventDefault();
    self.request(e.target.getAttribute('data-num'));

    if(self.status === 'sort') {
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

  this.request = function(num) {
    var url = siteURL + "/panel/api/pages/" + self.status + "/" + currentURI;
    var request = new XMLHttpRequest();
    request.open('POST', url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send('to='+num);
  };

};


if ('querySelector' in document && 'addEventListener' in window) {
  var toggle   = document.querySelector(".panelbar--toggle");
  var toggleJS = new PanelbarToggle(toggle);
  toggleJS.init();
}
