(function($) {
  Drupal.behaviors.ResizePopup = {
    attach: function(context, settings) {
      var resize = function(e) {
        var style = drupalSettings.modal_content.popup_style;
        if(style.responsive){
          if ($(window).width() > style.breakpoint){
            modalSize = style.modalSize;
            $(".popup-dialog-class").removeClass("responsive");
          } else {
            modalSize = style.modalSizeMobile;
            $(".popup-dialog-class").addClass("responsive");
          }
        } else {
          modalSize = style.modalSize;
        }
        var width = 0;
        var height = 0;
        if (modalSize.type == 'scale') {
          width = $(window).width() * modalSize.width;
          height = window.innerHeight * modalSize.height;
        }
        else {
          width = modalSize.width;
          height = modalSize.height;
        }
        modal_height = height;
        // Use the additionol pixels for creating the width and height.
        $('div.ctools-modal-content', context).css({
          //'width': width + 'px',
          //'height': height + 'px',
        });
        $('div.ctools-modal-content .modal-scroll', context).css({
          //'width': (width) + 'px',
          //'height': (height - modalSize.contentBottom) + 'px',
        });
      };
      resize();
    }
  };
}(jQuery));