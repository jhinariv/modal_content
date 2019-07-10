(function($) {
  Drupal.behaviors.ResizePopup = {
    attach: function(context, settings) {
      var resize = function(e) {
        var config = drupalSettings.modal_content_config, style = drupalSettings.modal_content, width = 0, height = 0, modalSize = style.modalSize;
        if(style.responsive){
          if ($(window).width() > style.breakpoint){
            modalSize = style.modalSize;
            $(".popup-dialog-class").removeClass("responsive");
          } else {
            modalSize = style.modalSizeMobile;
            $(".popup-dialog-class").addClass("responsive");
          }
        }
        if (modalSize.type == 'scale') {
          width = $(window).width() * modalSize.width;
          height = window.innerHeight * modalSize.height;
        }
        else {
          width = config.modal_width;
          height = modalSize.height;
        }
        modal_height = height;
      };
      resize();
    }
  };
}(jQuery));