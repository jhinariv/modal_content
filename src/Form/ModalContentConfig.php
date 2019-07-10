<?php

namespace Drupal\modal_content\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * ModalContentConfig class.
 */
class ModalContentConfig extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'modal_content.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'modal_content_config';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('modal_content.settings')->get('styles');

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $form['general'] = [
      '#type' => 'details',
      '#title' => t('General'),
      '#group' => 'advanced',
    ];

    $form['general']['info'] = [
      '#type' => 'markup',
      '#markup' => t('Los siguientes campos coresponden los estilos para el modal, aplicaran en todos los que se agregen en este sitio.'),
    ];

    $form['general']['modal_width'] = [
      '#type' => 'textfield',
      '#title' => t('Width'),
      '#description' => 'By default 400px',
      '#default_value' => $config['modal_width'] ? $config['modal_width'] : 400,
      '#required' => TRUE,
    ];

    $form['general']['modal_background_color'] = [
      '#type' => 'textfield',
      '#title' => t('Background color'),
      '#description' => 'By default #fff',
      '#default_value' => $config['modal_background_color'] ? $config['modal_background_color'] : '#fff',
    ];

    $form['general']['modal_color'] = [
      '#type' => 'textfield',
      '#title' => t('Color'),
      '#description' => 'By default #000',
      '#default_value' => $config['modal_color'] ? $config['modal_color'] : '#000',
    ];

    $form['general']['modal_button_close'] = [
      '#type' => 'checkbox',
      '#title' => t('Show button close'),
      '#description' => 'By default true',
      '#default_value' => $config['modal_button_close'] ? $config['modal_button_close'] : TRUE,
    ];

    $form['general']['modal_background_color_button_close'] = [
      '#type' => 'textfield',
      '#title' => t('Background color by the button'),
      '#description' => 'By default #ff7f50',
      '#default_value' => $config['modal_background_color_button_close'] ? $config['modal_background_color_button_close'] : '#ff7f50',
    ];

    $form['general']['modal_color_button_close'] = [
      '#type' => 'textfield',
      '#title' => t('Color by the button'),
      '#description' => 'By default #828282',
      '#default_value' => $config['modal_color_button_close'] ? $config['modal_color_button_close'] : '#828282',
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    \Drupal::configFactory()->getEditable('modal_content.settings')
      ->set('styles', $form_state->getValues())
      ->save();
  }

}
