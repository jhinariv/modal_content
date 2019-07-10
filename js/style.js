(function($) {
  Drupal.behaviors.StylePopup = {
    attach: function(context, settings) {
      var config = drupalSettings.modal_content_config, style = drupalSettings.modal_content;
      $('#drupal-modal').css('background-color', config.modal_background_color);
      $('#drupal-modal').css('color', config.modal_color);
      $('.modal-footer span').css('background-color', config.modal_background_color_button_close);
      $('.modal-footer span').css('color', config.modal_color_button_close);
    }
  };
}(jQuery));