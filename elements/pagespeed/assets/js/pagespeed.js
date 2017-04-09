
  var panelBarPageSpeed = document.getElementById('panelBar--pagespeed').children[1].children[0];

  var xhr = new XMLHttpRequest();
  xhr.open('GET', panelBarPageSpeed.children[0].dataset.route);
  xhr.onload = function() {
    if (xhr.status === 200) {
      panelBarPageSpeed.innerHTML = xhr.responseText;
    } else {
      alert('PageSpped API request failed. Status: ' + xhr.status);
    }
  };
  xhr.send();
