(function($) {
  Drupal.behaviors.ClosePopup = {
    attach: function() {
      popup = $('.popup-dialog-class');
      // simulate click en link by default of popup close
      // when user click in button "Regresar"
      $("span.footer-popups-close").on('click', function () {
        $(".ui-dialog-titlebar-close").trigger('click');
      });
      $(document).on('click', function(event){
        var container = $('.popup-dialog-class');
        if (!container.is(event.target) &&            // If the target of the click isn't the container...
          container.has(event.target).length === 0) // ... nor a descendant of the container
        {
          $(".ui-dialog-titlebar-close").trigger('click');
        } else {
        }
      });
    }
  };
  Drupal.behaviors.AlingnPopup = {
    attach: function() {
      popup = $('.popup-dialog-class');
      function alignCenter () {
        var wpopup = popup.width();
        var hpopup = popup.height();
        // Window size.
        var hwindow = $(window).height();
        var wwindow = $(window).width();
        var Left = Math.max(parseInt($(window).width()/2 - wpopup/2));
        var Top = Math.max(parseInt($(window).height()/2 - hpopup/2));
        if(hwindow < hpopup) {
          popup.css({'position':'fixed'});
        }
        else {
          popup.css({'position':'fixed'});
        }
        if(Top < 0){
          Top = 0;
        }
        if(Left < 0){
          Left = 0;
        }
        popup.css({'left':Left, 'top':Top, 'border-radius' : 0});
      }
      alignCenter();
      $(window).resize(function() {
        alignCenter();
      });
      $(window).scroll(function() {
        alignCenter();
      });
      popup.resize(function(){
        alignCenter();
      });
    }
  };
}(jQuery));
