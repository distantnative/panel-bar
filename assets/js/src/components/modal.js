(function (panelBar) {

  // =============================================
  //  Helpers
  // =============================================

  var wrapper = document.querySelector('.panelBar-modal');
  var overlay = document.querySelector('.panelBar-modal__overlay');

  panelBar.modal = {
    dom : {
      wrapper: wrapper,
      overlay: overlay,
      close:   wrapper.querySelector('.panelBar-modal__close')
    },

    show: function(modal) {
      cl.add(modal, 'is-open');
    },

    bind : function(element, modalID) {
      var modal = document.querySelector('.panelBar-modal--' + modalID);
      var links = panelBar.dom.bar.querySelectorAll(element);
      var i;
      for (i = 0; i < links.length; i++) {
        if(links[i].getAttribute('href') === '#modal')
        links[i].addEventListener('click', function(e) {
          e.preventDefault();
          _.close();
          _.show(modal);
        });
      }
    },

    close: function() {
      var modal = document.querySelector('.panelBar-modal.is-open');
      if(modal !== null) cl.remove(modal, 'is-open');
    },

    init: function() {
      var close = document.querySelectorAll('.panelBar-modal__close');
      var i;
      for (i = 0; i < close.length; i++) {
        close[i].addEventListener('click', function(e) {
          e.preventDefault();
          cl.remove(this.parentElement, 'is-open');
        });
      }

      document.querySelector('.panelBar-modal__overlay').addEventListener('click', function(e) {
        _.close();
      });
    },

  };

  var _ = panelBar.modal;

})(panelBar);

panelBar.modal.init();
