
var panelBarLoadtime = function() {

  var self = this;

  this.btn   = panelBar.bar.querySelector(".panelBar--loadtime");
  this.label = this.btn.children[0].children[1];

  this.init = function() {
    self.label.innerHTML = '…';
    var start   = new Date().getTime();
    var request = new XMLHttpRequest();
    request.open('POST', window.location.href , true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.onreadystatechange = function() {
      if (request.readyState === 4 && request.status === 200) {
        self.label.innerHTML = ((new Date().getTime() - start)/1000).toFixed(2);
      }
    };
    request.send('panelBar=0');
  };


  this.init();
};

var pbLoadtime = new panelBarLoadtime();
