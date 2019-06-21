<?php

namespace Drupal\modal_content;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Url;

/**
 * Class ModalContentService.
 *
 * @package Drupal\modal_content
 */
class ModalContentService {

  protected $api;
  public $popupStyle;

  /**
   * Constructor.
   */
  public function __construct() {
    $this->popupStyle = $this->modalContentCtoolsPopupStyle();
  }

  /**
   * Return a link text with behavior to open popup with term and conditions node.
   */
  public function modalContentAdd($text, $nid) {
    $options['attributes'] = [
      'class' => ['use-ajax'],
      'data-accepts' => 'application/vnd.drupal-dialog',
      'data-dialog-type' => 'modal',
      'data-dialog-options' => Json::encode(['width' => 500]),
    ];
    $options['absolute'] = TRUE;
    if ($this->modalContentIsSsl()) {
      $options['https'] = TRUE;
    }
    $params = ['js' => 'nojs', 'nid' => $nid, 'button_close' => 1];
    /* Let's create the link. */
    $url = Url::fromRoute('modal.content_content_controller_modal', $params, $options);
    $internal_link = \Drupal::l($text, $url);
    $link = [
      '#type' => 'markup',
      '#markup' => $internal_link,
      '#attached' => [
        'drupalSettings' => [
          'modal_content' => $this->popupStyle,
        ],
        'library' => [
          'modal_content/modal_content',
        ],
      ],
    ];
    return $link;
  }

  /**
   * ModalContentCtoolsPopupStyle function.
   */
  protected function modalContentCtoolsPopupStyle() {
    static $added = FALSE;
    $popupStyle = [];
    if ($added == FALSE) {
      $added = TRUE;
      /* Setting up the preferences for the popup */
      $popupStyle = [
        'popup_style' => [
          'modalSize' => [
            'type' => 'fixed', /* Popup type. */
            'width' => '500', /* Width */
            'height' => '600', /* Height */
            'addHeight' => 700, /* Maximum height */
            'addWidth' => 500,
            'contentBottom' => 100,
          ],
          'modalSizeMobile' => [
            'type' => 'scale', /* Popup type. */
            'width' => '1', /* Width */
            'height' => '1', /* Height */
            'addHeight' => 700, /* Maximum height */
            'addWidth' => 1,
            'contentBottom' => 60,
          ],
          'responsive' => TRUE,
          'breakpoint' => 768,
          'modalOptions' => [
            'opacity' => (float) 0.8, /* Backgroung opacity */
            'background-color' => '#084b57', /* Background color */
          ],
          'closeText' => '', /* Text for the «close» button */
          'loadingText' => '...', /* Text with the popup downloading */
          'animation' => 'fadeIn', /* Animation type */
          'modalTheme' => 'tac_modal_theme', /* Name of theme to be added */
          'animationSpeed' => 'slow', /* Popup animation speed */
        ],
      ];
    }
    return $popupStyle;
  }

  /**
   * ModalContentIsSsl function.
   */
  public function modalContentIsSsl() {
    if ((isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') || (!empty($_SERVER['HTTPS']))) {
      return TRUE;
    }
    return FALSE;
  }

}
