<?php

namespace Drupal\modal_content\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

/**
 * Class ModalContentController.
 *
 * @package Drupal\modal_content\Controller
 */
class ModalContentController extends ControllerBase {

  /**
   * Page function.
   */
  public function page() {
    $modal_content = \Drupal::service('modal.content');
    $link = $modal_content->modalContentAdd($this->t('términos y condiciones'), '1');
    return $link;
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
      '#button_close' => TRUE,
    ];
    $html = render($theme);
    $content['#markup'] = $html;
    $dialog_options = [
      'dialogClass' => 'popup-dialog-class',
      'width' => 400,
      'maxWidth' => 1000,
      'modal' => TRUE,
      'fluid' => TRUE,
      'resizable' => TRUE,
    ];
    $response->addCommand(new OpenModalDialogCommand($title, $content, $dialog_options));
    return $response;
  }

}
