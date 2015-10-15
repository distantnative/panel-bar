
var PanelBarToggle = function(element) {

  var self = this;

  this.button    = element.children[0];
  this.droplinks = element.querySelectorAll(".panelbar-drop__list > a");
  this.icon      = this.button.children[0];
  this.text      = this.button.children[1];
  this.status    = this.text.innerHTML === 'Visible' ? 'hide' : 'sort';


  this.init = function() {
    if(self.status == 'hide') {
      self.button.addEventListener('click', self.click);
    } else {
      self.button.style.cursor = 'default';
      var i;
      for (i = 0; i < self.droplinks.length; i++) {
        self.droplinks[i].setAttribute('data-num' , (i + 1));
        self.droplinks[i].addEventListener('click', function(e){
          self.click(e);
        });
      }
    }
  };

  this.click = function(e) {
    e.preventDefault();

    if(self.status === 'sort') {
      removeClass(self.icon, 'fa-toggle-off');
      addClass(self.icon, 'fa-toggle-on');
      self.text.innerHTML = "Visible";
    } else {
      removeClass(self.icon, 'fa-toggle-on');
      addClass(self.icon, 'fa-toggle-off');
      self.text.innerHTML = "Invisible";
    }

    self.request(e.target.getAttribute('data-num'));
  };

  this.request = function(num) {
    var url     = siteURL + "/panel/api/pages/" + self.status + "/" + currentURI;
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
  var pbToggle = new PanelBarToggle(document.querySelector(".panelbar--toggle"));
}
