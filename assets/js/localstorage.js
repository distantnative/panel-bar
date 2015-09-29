function supports_html5_storage() {
  try {
    return 'localStorage' in window && window['localStorage'] !== null;
  } catch (e) {
    return false;
  }
}

function save_current_state() {
  localStorage['panelbar.expires'] = Date.now() + 3600000;

  // position
  if (hasClass(wrapper, 'panelbar--top')) {
    localStorage['panelbar.position'] = 'top';
  } else {
    localStorage['panelbar.position'] = 'bottom';
  }

  // visibility
  if (hasClass(panelbar, 'panelbar__bar--hidden')) {
    localStorage['panelbar.visibility'] = 'hide';
  } else {
    localStorage['panelbar.visibility'] = 'show';
  }
}

function restore_state() {
  // position
  if (localStorage['panelbar.position'] === 'top') {
    removeClass(wrapper, 'panelbar--bottom');
    addClass(wrapper, 'panelbar--top');
  } else {
    removeClass(wrapper, 'panelbar--top');
    addClass(wrapper, 'panelbar--bottom');
  }

  // visibility
  if (localStorage['panelbar.visibility'] === 'show') {
    removeClass(panelbar, 'panelbar__bar--hidden');
  } else {
    addClass(panelbar, 'panelbar__bar--hidden');
  }
}

function reset_storage() {
  localStorage.removeItem("panelbar.expires");
  localStorage.removeItem("panelbar.position");
  localStorage.removeItem("panelbar.visibility");
}

if(supports_html5_storage()) {
  if(Date.now() < localStorage['panelbar.expires']) {
    restore_state();
  } else {
    reset_storage();
  }

  //bind action
  save_current_state();
  switchbtn.addEventListener('click', save_current_state);
  flipbtn.addEventListener('click', save_current_state);
}
