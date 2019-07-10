<?php

namespace Drupal\modal_content\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

/**
 * Class ModalContent.
 *
 * @package Drupal\modal_content\Controller
 */
class ModalContent extends ControllerBase {

  protected $config;

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->config = \Drupal::config('modal_content.settings')->get('styles');
  }

  /**
   * Page function.
   */
  public function page() {
    $modal = \Drupal::service('modal.content');
    return $modal->modalContentAdd('Open Modal', 1);
  }

  /**
   * Modal function.
   */
  public function modal($nid) {
    $response = new AjaxResponse();
    if (is_null($nid)) {
      $title = "Error";
      $text = $this->t("Contenido no disponible.");
    }
    else {
      $node = Node::load($nid);
      if (is_null($node)) {
        $title = "Error";
        $text = $this->t("Contenido no disponible.");
      }
      else {
        $title = $node->getTitle();
        $body = $node->get('body')->getValue();
        $body = reset($body)['value'];
        $render = [
          '#markup' => '<h2>' . $title . '</h2>' . $body,
        ];
        $text = render($render);
      }
    }
    $theme = [
      '#theme' => 'modal_content',
      '#content' => $text,
      '#button_close' => $this->config['modal_button_close'],
    ];
    $html = render($theme);
    $content['#markup'] = $html;
    $dialog_options = [
      'dialogClass' => 'popup-dialog-class',
      'width' => $this->config['modal_width'],
      'maxWidth' => 1000,
      'modal' => TRUE,
      'fluid' => TRUE,
      'resizable' => TRUE,
    ];
    $response->addCommand(new OpenModalDialogCommand($title, $content, $dialog_options));
    return $response;
  }

}
